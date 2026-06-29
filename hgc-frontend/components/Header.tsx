"use client";

import React, { useState, useEffect } from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import {
  ChevronDown,
  Menu,
  X,
  Building2,
  Mountain,
  HardHat,
  Store,
  Landmark,
  Truck,
  Globe,
  Phone,
  Mail,
  ArrowRight,
} from "lucide-react";
import { useI18n } from "./useI18nStore";
import { t, type Lang } from "./translations";

const companySlugs = [
  { slug: "hcrc", accent: "#B22222", icon: Building2 },
  { slug: "albahrain", accent: "#1A237E", icon: Mountain },
  { slug: "zain-noorain", accent: "#F57C00", icon: HardHat },
  { slug: "almadinah", accent: "#2E7D32", icon: Store },
  { slug: "haramain", accent: "#FFD700", icon: Landmark },
  { slug: "alkoozi", accent: "#00838F", icon: Truck },
];

const navPaths = [
  { href: "/", key: "nav.home" },
  { href: "/about", key: "nav.about" },
  { href: "/projects", key: "nav.projects" },
  { href: "/media", key: "nav.media" },
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
  const pathname = usePathname();

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

  const isActive = (href: string) => pathname === href;

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${isScrolled
          ? "bg-[#0A1628]/95 backdrop-blur-xl shadow-2xl shadow-black/20 border-b border-white/5"
          : "bg-transparent"
        }`}
      dir={dir}
    >
      {/* Scroll-aware Top Bar */}
      <div
        className={`overflow-hidden transition-all duration-500 ${isScrolled ? "max-h-10 opacity-100" : "max-h-0 opacity-0"
          }`}
      >
        <div className="bg-[#C9A227]/10 border-b border-[#C9A227]/20">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between text-xs">
            <div className="flex items-center gap-4 text-[#C9A227]/80">
              <span className="flex items-center gap-1.5">
                <Phone className="w-3 h-3" />
                +93 (0) 711 111 694
              </span>
              <span className="hidden sm:flex items-center gap-1.5">
                <Mail className="w-3 h-3" />
                info@hcrc-af.com
              </span>
            </div>
            <span className="text-[#C9A227]/60 text-xs">
              {t(lang, "footer.address")}
            </span>
          </div>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-20 lg:h-24">
          {/* Logo */}
          <Link href="/" className="flex items-center gap-3 group">
            <div className="relative w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center">
              <div className="absolute inset-0 bg-[#C9A227] rounded-lg rotate-3 group-hover:rotate-6 transition-transform duration-300" />
              <div className="absolute inset-0 bg-[#0A1628] rounded-lg border-2 border-[#C9A227] flex items-center justify-center">
                <span className="text-[#C9A227] font-bold text-lg lg:text-xl tracking-tighter">
                  HGC
                </span>
              </div>
            </div>
            <div className="hidden sm:block">
              <h1 className="text-white font-bold text-sm lg:text-base leading-tight tracking-wide">
                HAFEZ GROUP
              </h1>
              <p className="text-[#C9A227] text-[10px] lg:text-xs tracking-[0.2em] uppercase">
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
                className={`relative px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-lg group ${isActive(link.href)
                    ? "text-[#C9A227]"
                    : "text-white/70 hover:text-white"
                  }`}
              >
                {t(lang, link.key)}
                <span
                  className={`absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 bg-[#C9A227] transition-all duration-300 rounded-full ${isActive(link.href) ? "w-6" : "w-0 group-hover:w-4"
                    }`}
                />
              </Link>
            ))}

            {/* Companies Dropdown */}
            <div
              className="relative"
              onMouseEnter={() => setCompaniesOpen(true)}
              onMouseLeave={() => setCompaniesOpen(false)}
            >
              <button
                className={`flex items-center gap-1.5 px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-lg ${pathname.startsWith("/companies")
                    ? "text-[#C9A227]"
                    : "text-white/70 hover:text-white"
                  }`}
              >
                {t(lang, "nav.companies")}
                <ChevronDown
                  className={`w-4 h-4 transition-transform duration-300 ${companiesOpen ? "rotate-180" : ""
                    }`}
                />
              </button>

              <div
                className={`absolute top-full ${dir === "rtl" ? "right-0" : "left-0"
                  } pt-2 transition-all duration-300 ${companiesOpen
                    ? "opacity-100 translate-y-0 pointer-events-auto"
                    : "opacity-0 -translate-y-2 pointer-events-none"
                  }`}
              >
                <div className="bg-[#0A1628]/98 backdrop-blur-2xl border border-white/10 rounded-2xl shadow-2xl shadow-black/50 p-3 w-[420px]">
                  <div className="grid gap-1">
                    {companySlugs.map((company) => {
                      const Icon = company.icon;
                      const companyName = t(lang, `companies.${company.slug.replace("-", "")}.name`);
                      const companyDesc = t(lang, `companies.${company.slug.replace("-", "")}.desc`);
                      return (
                        <Link
                          key={company.slug}
                          href={`/companies/${company.slug}`}
                          className="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all duration-200 group/item"
                        >
                          <div
                            className="w-10 h-10 rounded-lg flex items-center justify-center transition-transform duration-200 group-hover/item:scale-110"
                            style={{ backgroundColor: `${company.accent}15` }}
                          >
                            <Icon
                              className="w-5 h-5"
                              style={{ color: company.accent }}
                            />
                          </div>
                          <div className="flex-1 min-w-0">
                            <p className="text-white text-sm font-medium truncate group-hover/item:text-[#C9A227] transition-colors">
                              {companyName}
                            </p>
                            <p className="text-white/40 text-xs">
                              {companyDesc}
                            </p>
                          </div>
                          <ArrowRight
                            className={`w-4 h-4 transition-all duration-200 text-white/20 group-hover/item:text-[#C9A227] ${dir === "rtl" ? "rotate-180" : ""
                              }`}
                          />
                        </Link>
                      );
                    })}
                  </div>
                </div>
              </div>
            </div>
          </nav>

          {/* Right Side: Language + Mobile */}
          <div className="flex items-center gap-3">
            {/* Language Dropdown - Fixed-width wrapper keeps button and dropdown identical */}
            <div className="relative w-32">
              <button
                onClick={() => setLangMenuOpen(!langMenuOpen)}
                className="flex items-center justify-between w-full px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 hover:border-[#C9A227]/30 transition-all duration-300 text-sm"
              >
                <div className="flex items-center gap-2 truncate">
                  <Globe className="w-4 h-4 text-[#C9A227] shrink-0" />
                  <span className="text-white font-medium truncate">
                    {languages.find((l) => l.code === lang)?.label}
                  </span>
                </div>
                <ChevronDown
                  className={`w-3 h-3 text-white/50 transition-transform shrink-0 ${langMenuOpen ? "rotate-180" : ""
                    }`}
                />
              </button>

              {langMenuOpen && (
                <>
                  <div
                    className="fixed inset-0 z-10"
                    onClick={() => setLangMenuOpen(false)}
                  />
                  {/* Matches button width perfectly using w-full and right-0 / left-0 constraints */}
                  <div className="absolute top-full mt-2 left-0 right-0 z-20 bg-[#0A1628]/98 backdrop-blur-2xl border border-white/10 rounded-xl shadow-2xl p-1.5 w-full">
                    <div className="flex flex-col gap-0.5">
                      {languages.map((l) => (
                        <button
                          key={l.code}
                          onClick={() => {
                            setLang(l.code);
                            setLangMenuOpen(false);
                          }}
                          /* Safely alignments localized typography scripts */
                          dir={l.code === "en" ? "ltr" : "rtl"}
                          className={`w-full flex items-center justify-start gap-2 px-3 py-2 rounded-lg text-sm transition-all ${lang === l.code
                              ? "bg-[#C9A227]/15 text-[#C9A227] font-semibold"
                              : "text-white/70 hover:bg-white/5 hover:text-white"
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
              className="lg:hidden p-2 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 transition-colors"
            >
              {mobileOpen ? (
                <X className="w-5 h-5 text-white" />
              ) : (
                <Menu className="w-5 h-5 text-white" />
              )}
            </button>
          </div>

        </div>
      </div>

      {/* Mobile Menu */}
      <div
        className={`lg:hidden fixed inset-0 top-20 bg-[#0A1628]/98 backdrop-blur-2xl transition-all duration-500 ${mobileOpen
            ? "opacity-100 pointer-events-auto"
            : "opacity-0 pointer-events-none"
          }`}
      >
        <div className="max-w-7xl mx-auto px-4 py-6 space-y-2 overflow-y-auto h-full pb-24">
          {navPaths.map((link) => (
            <Link
              key={link.href}
              href={link.href}
              className={`block px-4 py-3 rounded-xl text-base font-medium transition-all ${isActive(link.href)
                  ? "bg-[#C9A227]/10 text-[#C9A227] border border-[#C9A227]/20"
                  : "text-white/70 hover:text-white hover:bg-white/5"
                }`}
            >
              {t(lang, link.key)}
            </Link>
          ))}

          <div className="pt-4">
            <p className="px-4 text-xs uppercase tracking-wider text-[#C9A227]/60 mb-3">
              {t(lang, "footer.ourCompanies")}
            </p>
            <div className="space-y-1">
              {companySlugs.map((company) => {
                const Icon = company.icon;
                return (
                  <Link
                    key={company.slug}
                    href={`/companies/${company.slug}`}
                    className="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors"
                  >
                    <div
                      className="w-9 h-9 rounded-lg flex items-center justify-center"
                      style={{ backgroundColor: `${company.accent}15` }}
                    >
                      <Icon
                        className="w-4 h-4"
                        style={{ color: company.accent }}
                      />
                    </div>
                    <span className="text-white/80 text-sm">
                      {t(lang, `companies.${company.slug.replace("-", "")}.name`)}
                    </span>
                  </Link>
                );
              })}
            </div>
          </div>
        </div>
      </div>
    </header>
  );
}