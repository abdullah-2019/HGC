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

export default function Header() {
  const { lang, setLang, dir } = useI18n();
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);
  const [companiesOpen, setCompaniesOpen] = useState(false);
  const [langMenuOpen, setLangMenuOpen] = useState(false);
  const [companies, setCompanies] = useState<Company[]>([]);
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
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/companies?lang=${lang}`;
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

  return (
    <>
      <header
        className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${
          isScrolled
            ? "hgc-stripe-bg shadow-2xl shadow-hgc-header-text/10 border-b border-hgc-header-border"
            : "hgc-stripe-bg border-b border-hgc-header-border"
        }`}
        dir={dir}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
          <div className="flex items-center justify-between h-20 lg:h-24">
            {/* Logo */}
            <Link href="/" className="flex items-center gap-3 group">
              <div className="relative w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center">
                <div className="absolute inset-0 bg-hgc-accent rounded-lg rotate-3 group-hover:rotate-6 transition-transform duration-300" />
                <div className="absolute inset-0 bg-hgc-logo-bg rounded-lg border-2 border-hgc-accent flex items-center justify-center">
                  <span className="text-hgc-logo-text font-bold text-lg lg:text-xl tracking-tighter">
                    HGC
                  </span>
                </div>
              </div>
              <div className="hidden sm:block">
                <h1 className="text-hgc-header-text font-bold text-sm lg:text-base leading-tight tracking-wide">
                  HAFEZ GROUP
                </h1>
                <p className="text-hgc-accent text-[10px] lg:text-xs tracking-[0.2em] uppercase">
                  {t(lang, "footer.brandSubtitle") || "of Companies"}
                </p>
              </div>
            </Link>

            {/* Desktop Navigation */}
            <nav className="hidden lg:flex items-center gap-1">
              {navPaths.map((link) => (
                <Link
                  key={link.href}
                  href={link.href}
                  className={`relative px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-lg group ${
                    isActive(link.href)
                      ? "text-hgc-accent"
                      : "text-hgc-header-text/80 hover:text-hgc-header-text"
                  }`}
                >
                  {t(lang, link.key)}
                  <span
                    className={`absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 bg-hgc-accent transition-all duration-300 rounded-full ${
                      isActive(link.href) ? "w-6" : "w-0 group-hover:w-4"
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
                  className={`flex items-center gap-1.5 px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-lg ${
                    pathname.startsWith("/companies")
                      ? "text-hgc-accent"
                      : "text-hgc-header-text/80 hover:text-hgc-header-text"
                  }`}
                >
                  {t(lang, "nav.companies")}
                  <ChevronDown
                    className={`w-4 h-4 transition-transform duration-300 ${
                      companiesOpen ? "rotate-180" : ""
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
                    className={`w-3 h-3 text-hgc-header-text/50 transition-transform shrink-0 ${
                      langMenuOpen ? "rotate-180" : ""
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
                            className={`w-full flex items-center justify-start gap-2 px-3 py-2 rounded-lg text-sm transition-all ${
                              lang === l.code
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
            className={`hidden lg:block absolute left-1/2 -translate-x-1/2 top-full z-50 transition-all duration-300 ${
              companiesOpen
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
                            ? "سبد متنوع کسب‌وکارهای ما را کشف کنید"
                            : "زموږ د سوداګرۍ متنوع پورټفولیو وګورئ"}
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
                                  className={`w-3.5 h-3.5 opacity-0 -translate-x-1 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all duration-200 text-hgc-accent shrink-0 ${
                                    dir === "rtl" ? "rotate-180" : ""
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
                        className={`w-3.5 h-3.5 transition-transform duration-200 group-hover/all:translate-x-0.5 ${
                          dir === "rtl" ? "rotate-180" : ""
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
        className={`lg:hidden fixed inset-x-0 bottom-0 top-20 z-[9999] hgc-stripe-bg transition-all duration-500 ${
          mobileOpen
            ? "opacity-100 pointer-events-auto translate-x-0"
            : "opacity-0 pointer-events-none translate-x-full"
        }`}
      >
        <div className="h-full overflow-y-auto px-4 py-6 pb-24 space-y-2">
          {navPaths.map((link) => (
            <Link
              key={link.href}
              href={link.href}
              className={`block px-4 py-3 rounded-xl text-base font-medium transition-all ${
                isActive(link.href)
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