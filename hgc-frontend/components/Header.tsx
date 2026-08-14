"use client";

import React, { useState, useEffect, useRef, useCallback } from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import {
  ChevronDown,
  Menu,
  X,
  Globe,
  ArrowRight,
  Loader2,
  Building2,
  Layers,
} from "lucide-react";
import * as LucideIcons from "lucide-react";
import type { LucideIcon } from "lucide-react";
import { useI18n } from "./useI18nStore";
import { t, type Lang } from "./translations";

// ── Dynamic Icon Resolver ─────────────────────────────────────────
function resolveIcon(iconName: string): LucideIcon {
  const normalized = iconName
    .split(/[-_]/)
    .map((w) => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase())
    .join("");
  const Icon = (LucideIcons as Record<string, unknown>)[normalized];
  return (Icon as LucideIcon) || LucideIcons.Building2;
}

// ── Brand Title Splitter (matches Footer.tsx) ─────────────────────
function splitBrandTitle(title: string, lang: string): { main: string; sub: string } {
  const trimmed = title.trim();
  if (!trimmed) return { main: "", sub: "" };

  if (lang === "en") {
    const match = trimmed.match(/^(HAFEZ|Hafiz|HAFIZ)\b\s*(.*)/i);
    if (match) return { main: match[1].toUpperCase(), sub: match[2].trim() };
    const parts = trimmed.split(/\s+/);
    if (parts.length > 1) return { main: parts[0], sub: parts.slice(1).join(" ") };
    return { main: trimmed, sub: "" };
  }

  const hafezVariants = ["حافظ"];
  for (const variant of hafezVariants) {
    const idx = trimmed.indexOf(variant);
    if (idx >= 0) {
      const before = trimmed.slice(0, idx).trim();
      const after = trimmed.slice(idx + variant.length).trim();
      return { main: variant, sub: [before, after].filter(Boolean).join(" ") };
    }
  }

  const parts = trimmed.split(/\s+/);
  if (parts.length > 1) return { main: parts[0], sub: parts.slice(1).join(" ") };
  return { main: trimmed, sub: "" };
}

// ── Compact BrandBlock for Header ─────────────────────────────────
function HeaderBrandBlock({ main, sub, lang }: { main: string; sub: string; lang: string }) {
  const isDari = lang === "dari";
  const isEnglish = lang === "en";
  const isRTL = lang === "dari" || lang === "pashto";

  const topText = isDari ? sub : main;
  const bottomText = isDari ? main : sub;

  const topWords = topText.trim().split(/\s+/);
  const bottomWords = bottomText.trim().split(/\s+/);

  if (!sub) {
    return (
      <h1 className="text-hgc-header-text font-bold text-sm lg:text-base leading-tight tracking-wide">
        {main}
      </h1>
    );
  }

  return (
    <div className="inline-grid" dir={isRTL ? "rtl" : "ltr"}>
      {/* Top line */}
      <div
        className={`flex items-baseline whitespace-nowrap gap-1 ${topWords.length > 1 ? "justify-between" : ""
          } ${isDari
            ? "text-[10px] lg:text-xs font-semibold text-hgc-header-text/90"
            : isEnglish
              ? "text-base lg:text-lg font-black text-hgc-header-text"
              : "text-base lg:text-lg font-black text-hgc-header-text"
          }`}
      >
        {topWords.map((w, i) => (
  <span key={i} className="inline-block whitespace-nowrap">
    {w === "حافظ" ? "حــــــافظ" : w}
  </span>
))}
      </div>

      {/* Gold separator */}
      <div className="my-1 h-px w-full bg-gradient-to-r from-transparent via-hgc-gold to-transparent" />

      {/* Bottom line */}
      <div
        className={`flex items-baseline whitespace-nowrap gap-1 ${bottomWords.length > 1 ? "justify-between" : ""
          } ${isDari
            ? "text-base lg:text-lg font-black text-hgc-header-text"
            : isEnglish
              ? "text-[9px] lg:text-[10px] font-semibold text-hgc-accent uppercase tracking-widest"
              : "text-[10px] lg:text-xs font-semibold text-hgc-accent"
          }`}
      >
        {bottomWords.map((w, i) => (
          <span key={i} className="inline-block whitespace-nowrap">
            {w === "حافظ" ? "حـــــــــافظ" : w}
          </span>
        ))}
      </div>
    </div>
  );
}

interface Company {
  id: number;
  slug: string;
  name: string;
  short_name: string;
  description: string;
  accent_color: string;
  icon_name: string;
  logo_url: string | null;
  hero_image_url: string | null;
}

interface SiteSettings {
  brandTitleEn: string;
  brandTitleDari: string | null;
  brandTitlePashto: string | null;
  brandSubtitleEn: string;
  brandSubtitleDari: string | null;
  brandSubtitlePashto: string | null;
}

const navPaths = [
  { href: "/", key: "nav.home" },
  { href: "/about", key: "nav.about" },
  { href: "/projects", key: "nav.projects" },
  { href: "/products", key: "nav.products" },
  { href: "/contact", key: "nav.contact" },
];

const languages: { code: Lang; label: string }[] = [
  { code: "en", label: "English" },
  { code: "dari", label: "دری" },
  { code: "pashto", label: "پښتو" },
];

const API_BASE = process.env.NEXT_PUBLIC_API_URL || "https://api.hgc.af";

function getLocalizedText(
  lang: string,
  en: string,
  dari: string | null,
  pashto: string | null
): string {
  if (lang === "dari" && dari) return dari;
  if (lang === "pashto" && pashto) return pashto;
  return en;
}

export default function Header() {
  const { lang, setLang, dir } = useI18n();
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);
  const [companiesOpen, setCompaniesOpen] = useState(false);
  const [langMenuOpen, setLangMenuOpen] = useState(false);
  const [companies, setCompanies] = useState<Company[]>([]);
  const [settings, setSettings] = useState<SiteSettings | null>(null);
  const [loadingCompanies, setLoadingCompanies] = useState(true);
  const pathname = usePathname();

  const companiesBtnRef = useRef<HTMLDivElement>(null);
  const dropdownRef = useRef<HTMLDivElement>(null);
  const [arrowLeft, setArrowLeft] = useState<number | null>(null);

  // Lock body scroll when mobile menu is open
  useEffect(() => {
    if (mobileOpen) {
      document.body.style.overflow = "hidden";
    } else {
      document.body.style.overflow = "";
    }
    return () => {
      document.body.style.overflow = "";
    };
  }, [mobileOpen]);

  // Fetch companies from API
  useEffect(() => {
    const fetchCompanies = async () => {
      try {
        const apiUrl = `${API_BASE}/api/companies?lang=${lang}`;
        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
        });

        if (!res.ok) {
          throw new Error(`HTTP ${res.status}: ${res.statusText}`);
        }

        const contentType = res.headers.get("content-type");
        if (!contentType?.includes("application/json")) {
          const text = await res.text();
          throw new Error(`Expected JSON, got: ${text.substring(0, 100)}`);
        }

        const json = await res.json();
        if (json.success) {
          setCompanies(json.data);
        }
      } catch (err) {
        console.error("Header: Failed to fetch companies:", err);
        setCompanies([]);
      } finally {
        setLoadingCompanies(false);
      }
    };

    fetchCompanies();
  }, [lang]);

  // Fetch site settings for translated brand title
  useEffect(() => {
    const fetchSettings = async () => {
      try {
        const res = await fetch(`${API_BASE}/api/site-settings`, {
          headers: { Accept: "application/json" },
        });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();
        if (json.success) setSettings(json.data);
      } catch (err) {
        console.error("Header: Failed to fetch site settings:", err);
      }
    };
    fetchSettings();
  }, []);

  useEffect(() => {
    const handleScroll = () => setIsScrolled(window.scrollY > 20);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  useEffect(() => {
    setCompaniesOpen(false);
    setMobileOpen(false);
    setLangMenuOpen(false);
  }, [pathname]);

  // ── Arrow Position Calculator ───────────────────────────────────
  const updateArrowPosition = useCallback(() => {
    if (companiesBtnRef.current && dropdownRef.current) {
      const btnRect = companiesBtnRef.current.getBoundingClientRect();
      const dropdownRect = dropdownRef.current.getBoundingClientRect();

      const btnCenter = btnRect.left + btnRect.width / 2;
      const dropdownLeft = dropdownRect.left;

      let pos = btnCenter - dropdownLeft;
      pos = Math.max(16, Math.min(pos, dropdownRect.width - 16));
      setArrowLeft(pos);
    }
  }, []);

  useEffect(() => {
    updateArrowPosition();
    window.addEventListener("resize", updateArrowPosition);
    return () => window.removeEventListener("resize", updateArrowPosition);
  }, [updateArrowPosition]);

  useEffect(() => {
    if (companiesOpen) {
      const t = setTimeout(updateArrowPosition, 50);
      return () => clearTimeout(t);
    }
  }, [companiesOpen, updateArrowPosition]);

  const isActive = (href: string) => pathname === href;

  const companiesTimeoutRef = useRef<NodeJS.Timeout | null>(null);
  const openCompanies = () => {
    if (companiesTimeoutRef.current) clearTimeout(companiesTimeoutRef.current);
    setCompaniesOpen(true);
  };
  const closeCompanies = () => {
    companiesTimeoutRef.current = setTimeout(() => {
      setCompaniesOpen(false);
    }, 150);
  };

  const brandTitle = getLocalizedText(
    lang,
    settings?.brandTitleEn ?? "HAFEZ GROUP",
    settings?.brandTitleDari ?? null,
    settings?.brandTitlePashto ?? null
  );
  const brandParts = splitBrandTitle(brandTitle, lang);

  return (
    <>
      <header
        className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${isScrolled
          ? "hgc-stripe-bg shadow-2xl shadow-hgc-header-text/10 border-b border-hgc-header-border"
          : "hgc-stripe-bg border-b border-hgc-header-border"
          }`}
        dir={dir}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
          <div className="flex items-center justify-between h-20 lg:h-24">
            {/* Logo — styled like Footer logo block */}
            <Link href="/" className="flex items-center gap-3 group">
              <div className="relative shrink-0">
                <img
                  src="/logo.webp"
                  alt="HGC"
                  className="w-12 h-12 lg:w-14 lg:h-14 object-contain rounded-xl"
                />
                <div className="absolute inset-0 rounded-xl ring-1 ring-hgc-accent/15 group-hover:ring-hgc-accent/30 transition-all duration-300" />
              </div>
              <div className="hidden sm:block">
                <HeaderBrandBlock
                  main={brandParts.main}
                  sub={brandParts.sub}
                  lang={lang}
                />
              </div>
            </Link>

            {/* Desktop Navigation */}
            <nav className="hidden lg:flex items-center gap-1">
              {navPaths.map((link) => (
                <Link
                  key={link.href}
                  href={link.href}
                  className={`relative px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-lg group ${isActive(link.href)
                    ? "text-hgc-accent"
                    : "text-hgc-header-text/80 hover:text-hgc-header-text"
                    }`}
                >
                  {t(lang, link.key)}
                  <span
                    className={`absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 bg-hgc-accent transition-all duration-300 rounded-full ${isActive(link.href) ? "w-6" : "w-0 group-hover:w-4"
                      }`}
                  />
                </Link>
              ))}

              {/* Companies Button */}
              <div
                ref={companiesBtnRef}
                className="relative h-full flex items-center"
                onMouseEnter={openCompanies}
                onMouseLeave={closeCompanies}
              >
                <button
                  className={`flex items-center gap-1.5 px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-lg ${pathname.startsWith("/companies")
                    ? "text-hgc-accent"
                    : "text-hgc-header-text/80 hover:text-hgc-header-text"
                    }`}
                >
                  {t(lang, "nav.companies")}
                  <ChevronDown
                    className={`w-4 h-4 transition-transform duration-300 ${companiesOpen ? "rotate-180" : ""
                      }`}
                  />
                </button>
              </div>
            </nav>

            {/* Right Side: Language + Mobile */}
            <div className="flex items-center gap-3">
              {/* Language Dropdown */}
              <div className="relative w-32">
                <button
                  onClick={() => setLangMenuOpen(!langMenuOpen)}
                  className="flex items-center justify-between w-full px-3 py-1.5 rounded-lg bg-hgc-header-bg-hover border border-hgc-header-border hover:bg-hgc-header-bg-active hover:border-hgc-accent/30 transition-all duration-300 text-sm"
                >
                  <div className="flex items-center gap-2 truncate">
                    <Globe className="w-4 h-4 text-hgc-accent shrink-0" />
                    <span className="text-hgc-header-text font-medium truncate">
                      {languages.find((l) => l.code === lang)?.label}
                    </span>
                  </div>
                  <ChevronDown
                    className={`w-3 h-3 text-hgc-header-text/50 transition-transform shrink-0 ${langMenuOpen ? "rotate-180" : ""
                      }`}
                  />
                </button>

                {langMenuOpen && (
                  <>
                    <div
                      className="fixed inset-0 z-10"
                      onClick={() => setLangMenuOpen(false)}
                    />
                    <div className="absolute top-full mt-2 left-0 right-0 z-20 bg-hgc-dropdown-bg/98 backdrop-blur-2xl border border-hgc-dropdown-border rounded-xl shadow-2xl p-1.5 w-full">
                      <div className="flex flex-col gap-0.5">
                        {languages.map((l) => (
                          <button
                            key={l.code}
                            onClick={() => {
                              setLang(l.code);
                              setLangMenuOpen(false);
                            }}
                            dir={l.code === "en" ? "ltr" : "rtl"}
                            className={`w-full flex items-center justify-start gap-2 px-3 py-2 rounded-lg text-sm transition-all ${lang === l.code
                              ? "bg-hgc-header-text/10 text-hgc-header-text font-semibold"
                              : "text-hgc-dropdown-text-muted hover:bg-hgc-header-bg-hover hover:text-hgc-dropdown-text"
                              }`}
                          >
                            <span className="w-full text-start">{l.label}</span>
                          </button>
                        ))}
                      </div>
                    </div>
                  </>
                )}
              </div>

              {/* Mobile Toggle */}
              <button
                onClick={() => setMobileOpen(!mobileOpen)}
                className="lg:hidden p-2 rounded-lg bg-hgc-header-bg-hover border border-hgc-header-border hover:bg-hgc-header-bg-active transition-colors"
              >
                {mobileOpen ? (
                  <X className="w-5 h-5 text-hgc-header-text" />
                ) : (
                  <Menu className="w-5 h-5 text-hgc-header-text" />
                )}
              </button>
            </div>
          </div>

          {/* ═══════════════════════════════════════════════════════════════
              MEGA MENU — Companies (3 Columns + Upward Triangle Arrow)
              ═══════════════════════════════════════════════════════════════ */}
          <div
            ref={dropdownRef}
            className={`hidden lg:block absolute left-1/2 -translate-x-1/2 top-full z-50 transition-all duration-300 ${companiesOpen
              ? "opacity-100 translate-y-0 pointer-events-auto"
              : "opacity-0 -translate-y-3 pointer-events-none"
              }`}
            onMouseEnter={openCompanies}
            onMouseLeave={closeCompanies}
          >
            <div className="relative">
              {/* ▼ Arrow Pointer — upward triangle pointing to Companies button */}
              {/* Border triangle (slightly larger, behind) */}
              <div
                className="absolute z-[9] w-0 h-0"
                style={{
                  left: arrowLeft !== null ? `${arrowLeft}px` : "50%",
                  top: "-11px",
                  transform: "translateX(-50%)",
                  borderLeft: "11px solid transparent",
                  borderRight: "11px solid transparent",
                  borderBottom: "11px solid var(--hgc-dropdown-border, #e5e7eb)",
                }}
              />
              {/* Fill triangle (front) */}
              <div
                className="absolute z-10 w-0 h-0"
                style={{
                  left: arrowLeft !== null ? `${arrowLeft}px` : "50%",
                  top: "-10px",
                  transform: "translateX(-50%)",
                  borderLeft: "10px solid transparent",
                  borderRight: "10px solid transparent",
                  borderBottom: "10px solid var(--hgc-dropdown-bg, #ffffff)",
                }}
              />

              <div className="relative z-20 bg-hgc-dropdown-bg/98 backdrop-blur-2xl border border-hgc-dropdown-border rounded-2xl shadow-2xl shadow-hgc-header-text/10 w-[900px] max-w-[95vw] overflow-hidden">
                {/* Mega Menu Header */}
                <div className="px-6 py-4 border-b border-hgc-dropdown-border/50 bg-hgc-header-bg-hover/50">
                  <div className="flex items-center gap-3">
                    <div className="w-10 h-10 rounded-xl bg-hgc-gold/15 flex items-center justify-center">
                      <Layers className="w-5 h-5 text-hgc-gold" />
                    </div>
                    <div>
                      <h3 className="text-hgc-header-text font-semibold text-sm">
                        {t(lang, "footer.ourCompanies") || "Our Companies"}
                      </h3>
                      <p className="text-hgc-dropdown-text-muted text-xs mt-0.5">
                        {lang === "en"
                          ? "Explore our diverse portfolio of businesses"
                          : lang === "dari"
                            ? "مجموعه متنوع کسب و کارهای ما را بررسی کنید"
                            : "زموږ د سوداګرۍ متنوع پورټ فولیو وپلټئ"}
                      </p>
                    </div>
                  </div>
                </div>

                {/* Mega Menu Content — 3 COLUMNS */}
                <div className="p-4">
                  {loadingCompanies ? (
                    <div className="flex items-center justify-center py-10">
                      <Loader2 className="w-6 h-6 text-hgc-accent animate-spin" />
                    </div>
                  ) : companies.length === 0 ? (
                    <div className="py-8 text-center text-hgc-dropdown-text-muted text-sm">
                      {lang === "en"
                        ? "No companies found."
                        : lang === "dari"
                          ? "هیچ شرکتی یافت نشد."
                          : "هیڅ شرکت ونه موندل شو."}
                    </div>
                  ) : (
                    <div className="grid grid-cols-3 gap-2">
                      {companies.map((company) => {
                        const Icon = resolveIcon(company.icon_name);
                        return (
                          <Link
                            key={company.slug}
                            href={`/companies/${company.slug}`}
                            className="group/item flex items-start gap-3 p-3 rounded-xl hover:bg-hgc-header-bg-hover transition-all duration-200 border border-transparent hover:border-hgc-dropdown-border/50"
                          >
                            {/* Icon / Logo */}
                            <div
                              className="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 transition-all duration-200 group-hover/item:scale-110 group-hover/item:shadow-lg"
                              style={{
                                backgroundColor: `${company.accent_color}18`,
                                boxShadow: `0 0 0 0 ${company.accent_color}00`,
                              }}
                            >
                              {company.logo_url ? (
                                <img
                                  src={company.logo_url}
                                  alt={company.short_name}
                                  className="w-6 h-6 object-contain"
                                />
                              ) : (
                                <Icon
                                  className="w-5 h-5"
                                  style={{ color: company.accent_color }}
                                />
                              )}
                            </div>

                            {/* Text Content */}
                            <div className="flex-1 min-w-0 pt-0.5">
                              <div className="flex items-center gap-1.5">
                                <p className="text-hgc-dropdown-text text-sm font-semibold truncate group-hover/item:text-hgc-gold transition-colors">
                                  {company.name}
                                </p>
                                <ArrowRight
                                  className={`w-3.5 h-3.5 opacity-0 -translate-x-1 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all duration-200 text-hgc-accent shrink-0 ${dir === "rtl" ? "rotate-180" : ""
                                    }`}
                                />
                              </div>
                              <p className="text-hgc-dropdown-text-muted text-xs line-clamp-2 mt-1 leading-relaxed">
                                {company.description}
                              </p>
                            </div>
                          </Link>
                        );
                      })}
                    </div>
                  )}
                </div>

                {/* Mega Menu Footer */}
                {!loadingCompanies && companies.length > 0 && (
                  <div className="px-4 py-3 border-t border-hgc-dropdown-border/50 bg-hgc-header-bg-hover/30">
                    <Link
                      href="/companies"
                      className="flex items-center justify-center gap-2 text-xs font-medium text-hgc-accent hover:text-hgc-header-text-muted transition-colors group/all"
                    >
                      <span>
                        {lang === "en"
                          ? "View All Companies"
                          : lang === "dari"
                            ? "مشاهده همه شرکت‌ها"
                            : "ټول شرکتونه وګورئ"}
                      </span>
                      <ArrowRight
                        className={`w-3.5 h-3.5 transition-transform duration-200 group-hover/all:translate-x-0.5 ${dir === "rtl" ? "rotate-180" : ""
                          }`}
                      />
                    </Link>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </header>

      {/* Mobile Menu */}
      <div
        className={`lg:hidden fixed inset-x-0 bottom-0 top-20 z-[9999] hgc-stripe-bg transition-all duration-500 ${mobileOpen
          ? "opacity-100 pointer-events-auto translate-x-0"
          : "opacity-0 pointer-events-none translate-x-full"
          }`}
      >
        <div className="h-full overflow-y-auto px-4 py-6 pb-24 space-y-2">
          {navPaths.map((link) => (
            <Link
              key={link.href}
              href={link.href}
              className={`block px-4 py-3 rounded-xl text-base font-medium transition-all ${isActive(link.href)
                ? "bg-hgc-accent/15 text-hgc-accent border border-hgc-accent/25"
                : "text-hgc-header-text/80 hover:text-hgc-header-text hover:bg-hgc-header-bg-hover"
                }`}
            >
              {t(lang, link.key)}
            </Link>
          ))}

          <div className="pt-4">
            <p className="px-4 text-xs uppercase tracking-wider text-hgc-accent/60 mb-3">
              {t(lang, "footer.ourCompanies")}
            </p>
            {loadingCompanies ? (
              <div className="flex items-center justify-center py-4">
                <Loader2 className="w-5 h-5 text-hgc-accent animate-spin" />
              </div>
            ) : (
              <div className="space-y-1">
                {companies.map((company) => {
                  const Icon = resolveIcon(company.icon_name);
                  return (
                    <Link
                      key={company.slug}
                      href={`/companies/${company.slug}`}
                      className="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-hgc-header-bg-hover transition-colors"
                    >
                      <div
                        className="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
                        style={{
                          backgroundColor: `${company.accent_color}15`,
                        }}
                      >
                        <Icon
                          className="w-4 h-4"
                          style={{ color: company.accent_color }}
                        />
                      </div>
                      <span className="text-hgc-header-text/80 text-sm">
                        {company.name}
                      </span>
                    </Link>
                  );
                })}
              </div>
            )}
          </div>
        </div>
      </div>
    </>
  );
}