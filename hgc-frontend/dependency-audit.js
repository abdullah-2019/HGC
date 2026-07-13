#!/usr/bin/env node
/**
 * dependency-audit.js
 * 
 * Run this in your Next.js project root:
 *   node dependency-audit.js
 * 
 * It scans all JS/TS/JSX/TSX files for imports and compares against package.json
 * to find unused dependencies.
 */

const fs = require('fs');
const path = require('path');

// ── CONFIG ──────────────────────────────────────────────────────────
const SRC_DIRS = ['app', 'components', 'lib', 'hooks', 'utils', 'pages', 'src'];
const EXTENSIONS = ['.js', '.jsx', '.ts', '.tsx', '.mjs'];

// Packages that are always needed even if not directly imported
const ALWAYS_NEEDED = [
  'next',
  'react',
  'react-dom',
  '@types/react',
  '@types/react-dom',
  '@types/node',
  'typescript',
  'tailwindcss',
  'postcss',
  'autoprefixer',
  'eslint',
  'eslint-config-next',
];

// Packages used indirectly (e.g., via next.config.js, jest.config.js, etc.)
const CONFIG_USED = [
  'tailwindcss',
  'postcss',
  'autoprefixer',
  '@tailwindcss/typography',
  '@tailwindcss/forms',
  'tailwind-merge',
  'clsx',
  'class-variance-authority',
  'shadcn-ui',
];

// ── HELPERS ─────────────────────────────────────────────────────────
function findPackageJson(dir) {
  let current = dir;
  while (current !== path.dirname(current)) {
    const pkgPath = path.join(current, 'package.json');
    if (fs.existsSync(pkgPath)) return pkgPath;
    current = path.dirname(current);
  }
  return null;
}

function getAllSourceFiles(rootDir) {
  const files = [];
  function walk(dir) {
    if (!fs.existsSync(dir)) return;
    const entries = fs.readdirSync(dir, { withFileTypes: true });
    for (const entry of entries) {
      const fullPath = path.join(dir, entry.name);
      if (entry.isDirectory() && entry.name !== 'node_modules' && !entry.name.startsWith('.')) {
        walk(fullPath);
      } else if (entry.isFile() && EXTENSIONS.some(ext => entry.name.endsWith(ext))) {
        files.push(fullPath);
      }
    }
  }

  for (const srcDir of SRC_DIRS) {
    walk(path.join(rootDir, srcDir));
  }

  // Also check config files at root
  const rootConfigs = ['next.config.js', 'next.config.ts', 'next.config.mjs', 'tailwind.config.js', 'tailwind.config.ts', 'postcss.config.js', 'jest.config.js', 'vite.config.ts', 'tsconfig.json'];
  for (const cfg of rootConfigs) {
    const cfgPath = path.join(rootDir, cfg);
    if (fs.existsSync(cfgPath)) files.push(cfgPath);
  }

  return files;
}

function extractImports(content) {
  const imports = new Set();

  // import { ... } from "pkg"
  // import X from "pkg"
  // import * as X from "pkg"
  // import "pkg"
  // const X = require("pkg")
  // const { ... } = require("pkg")

  const patterns = [
    /import\s+\{[^}]+\}\s+from\s+["']([^"']+)["']/g,
    /import\s+\*\s+as\s+\w+\s+from\s+["']([^"']+)["']/g,
    /import\s+\w+\s+from\s+["']([^"']+)["']/g,
    /import\s+["']([^"']+)["']/g,
    /require\s*\(\s*["']([^"']+)["']\s*\)/g,
  ];

  for (const pattern of patterns) {
    let match;
    while ((match = pattern.exec(content)) !== null) {
      imports.add(match[1]);
    }
  }

  return Array.from(imports);
}

function getPackageName(importPath) {
  // "lucide-react" → "lucide-react"
  // "next/link" → "next"
  // "@radix-ui/react-dialog" → "@radix-ui/react-dialog"
  // "@/components/useI18nStore" → null (local)

  if (importPath.startsWith('.') || importPath.startsWith('@/')) return null;

  if (importPath.startsWith('@')) {
    // Scoped package: @scope/pkg or @scope/pkg/subpath
    const parts = importPath.split('/');
    if (parts.length >= 2) return `${parts[0]}/${parts[1]}`;
    return importPath;
  }

  // Regular package: pkg or pkg/subpath
  return importPath.split('/')[0];
}

// ── MAIN ──────────────────────────────────────────────────────────────
function main() {
  const rootDir = process.cwd();
  const packageJsonPath = findPackageJson(rootDir);

  if (!packageJsonPath) {
    console.error('❌ package.json not found');
    process.exit(1);
  }

  const pkg = JSON.parse(fs.readFileSync(packageJsonPath, 'utf8'));
  const allDeps = {
    ...pkg.dependencies,
    ...pkg.devDependencies,
  };

  const depNames = Object.keys(allDeps);
  const sourceFiles = getAllSourceFiles(rootDir);

  console.log(`\n📦 Found ${depNames.length} dependencies in package.json`);
  console.log(`📄 Found ${sourceFiles.length} source files to scan\n`);

  const usedPackages = new Set();
  const importDetails = {}; // pkg → [files]

  for (const file of sourceFiles) {
    const content = fs.readFileSync(file, 'utf8');
    const imports = extractImports(content);

    for (const imp of imports) {
      const pkgName = getPackageName(imp);
      if (!pkgName) continue;

      usedPackages.add(pkgName);
      if (!importDetails[pkgName]) importDetails[pkgName] = [];
      if (!importDetails[pkgName].includes(file)) {
        importDetails[pkgName].push(file);
      }
    }
  }

  // Categorize
  const used = [];
  const unused = [];
  const maybeUnused = [];

  for (const dep of depNames) {
    if (usedPackages.has(dep)) {
      used.push(dep);
    } else if (ALWAYS_NEEDED.includes(dep) || CONFIG_USED.includes(dep)) {
      maybeUnused.push(dep);
    } else {
      unused.push(dep);
    }
  }

  // ── OUTPUT ────────────────────────────────────────────────────────
  console.log('═══════════════════════════════════════════════════════════');
  console.log('  ✅ USED (directly imported in source files)');
  console.log('═══════════════════════════════════════════════════════════');
  for (const dep of used.sort()) {
    const files = importDetails[dep] || [];
    const fileList = files.length > 3 
      ? `${files.slice(0, 3).map(f => path.basename(f)).join(', ')}...` 
      : files.map(f => path.basename(f)).join(', ');
    console.log(`  ${dep.padEnd(30)} ${fileList ? '→ ' + fileList : ''}`);
  }

  console.log('\n═══════════════════════════════════════════════════════════');
  console.log('  ⚠️  MAYBE NEEDED (config/peer/build tools)');
  console.log('═══════════════════════════════════════════════════════════');
  for (const dep of maybeUnused.sort()) {
    const reason = ALWAYS_NEEDED.includes(dep) ? 'core framework' : 'config/build tool';
    console.log(`  ${dep.padEnd(30)} (${reason})`);
  }

  console.log('\n═══════════════════════════════════════════════════════════');
  console.log('  ❌ UNUSED (safe to uninstall)');
  console.log('═══════════════════════════════════════════════════════════');
  for (const dep of unused.sort()) {
    console.log(`  ${dep.padEnd(30)} ${allDeps[dep] ? '@' + allDeps[dep] : ''}`);
  }

  if (unused.length > 0) {
    console.log('\n💡 To uninstall all unused packages:');
    console.log(`   npm uninstall ${unused.join(' ')}`);
    console.log(`   # or: yarn remove ${unused.join(' ')}`);
    console.log(`   # or: pnpm remove ${unused.join(' ')}`);
  }

  console.log('\n📊 Summary:');
  console.log(`   Total deps:     ${depNames.length}`);
  console.log(`   Used:           ${used.length}`);
  console.log(`   Maybe needed:   ${maybeUnused.length}`);
  console.log(`   Unused:         ${unused.length}`);
  console.log(`   Potential savings: ${unused.length} packages\n`);
}

main();
