"use client";

import React, { useState, useEffect } from "react";
import Link from "next/link";
import {
  Building2,
  Mountain,
  HardHat,
  Store,
  Landmark,
  Truck,
  Phone,
  Mail,
  MapPin,
  ArrowUpRight,
  ChevronRight,
  Loader2,
} from "lucide-react";
import { useI18n } from "./useI18nStore";
import * as LucideIcons from "lucide-react";
import type { LucideIcon } from "lucide-react";

// ── Types ───────────────────────────────────────────────────────────
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

interface SocialLink {
  icon: string;
  label: string;
  url: string;
  is_active: boolean;
}

interface FooterLink {
  label_en: string;
  label_dari: string | null;
  label_pashto: string | null;
  href: string;
  sort_order: number;
}

interface SiteSettings {
  brandTitleEn: string;
  brandTitleDari: string | null;
  brandTitlePashto: string | null;
  brandSubtitleEn: string;
  brandSubtitleDari: string | null;
  brandSubtitlePashto: string | null;
  brandDescEn: string;
  brandDescDari: string | null;
  brandDescPashto: string | null;
  officeLabelEn: string;
  officeLabelDari: string | null;
  officeLabelPashto: string | null;
  addressEn: string;
  addressDari: string | null;
  addressPashto: string | null;
  phoneLabelEn: string;
  phoneLabelDari: string | null;
  phoneLabelPashto: string | null;
  phonePrimary: string;
  phoneSecondary: string | null;
  emailLabelEn: string;
  emailLabelDari: string | null;
  emailLabelPashto: string | null;
  emailAddress: string;
  socialLinks: SocialLink[];
  footerLinks: FooterLink[];
  copyrightEn: string;
  copyrightDari: string | null;
  copyrightPashto: string | null;
  privacyTextEn: string;
  privacyTextDari: string | null;
  privacyTextPashto: string | null;
  termsTextEn: string;
  termsTextDari: string | null;
  termsTextPashto: string | null;
}

// ── Icon Maps ───────────────────────────────────────────────────────
// const companyIconMap: Record<string, React.ElementType> = {
//   Building2, Mountain, HardHat, Store, Landmark, Truck,
// };
function resolveCompanyIcon(iconName: string): LucideIcon {
  // Normalize: ensure PascalCase
  const normalized = iconName.charAt(0).toUpperCase() + iconName.slice(1);
  const Icon = (LucideIcons as Record<string, unknown>)[normalized];
  return (Icon as LucideIcon) || LucideIcons.Building2;
}

function resolveIcon(iconName: string): LucideIcon {
  const normalized = iconName
    .split(/[-_]/)
    .map((w) => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase())
    .join("");
  const Icon = (LucideIcons as Record<string, unknown>)[normalized];
  return (Icon as LucideIcon) || LucideIcons.Globe;
}

// ── Social Icon Helper ────────────────────────────────────────────
function getSocialIcon(url: string): React.ReactNode {
  const lower = url.toLowerCase();

  // Facebook
  if (lower.includes("facebook.com") || lower.includes("fb.me")) {
    return (
      <svg viewBox="0 0 24 24" fill="currentColor" className="w-4 h-4">
        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
      </svg>
    );
  }

  // X / Twitter
  if (lower.includes("twitter.com") || lower.includes("x.com")) {
    return (
      <svg viewBox="0 0 24 24" fill="currentColor" className="w-4 h-4">
        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
      </svg>
    );
  }

  // LinkedIn
  if (lower.includes("linkedin.com")) {
    return (
      <svg viewBox="0 0 24 24" fill="currentColor" className="w-4 h-4">
        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
      </svg>
    );
  }

  // Instagram
  if (lower.includes("instagram.com")) {
    return (
      <svg viewBox="0 0 24 24" fill="currentColor" className="w-4 h-4">
        <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678a6.162 6.162 0 100 12.324 6.162 6.162 0 100-12.324zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405a1.441 1.441 0 11-2.882 0 1.441 1.441 0 012.882 0z" />
      </svg>
    );
  }

  // YouTube
  if (lower.includes("youtube.com") || lower.includes("youtu.be")) {
    return (
      <svg viewBox="0 0 24 24" fill="currentColor" className="w-4 h-4">
        <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
      </svg>
    );
  }

  // Telegram
  if (lower.includes("t.me") || lower.includes("telegram.me")) {
    return (
      <svg viewBox="0 0 24 24" fill="currentColor" className="w-4 h-4">
        <path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0011.944 0zm5.509 7.749c.144.288.156.624.012.912l-3.69 8.22c-.216.48-.768.72-1.248.528l-3.36-1.32-1.692 1.656c-.288.288-.696.396-1.068.276-.372-.12-.636-.444-.636-.828V14.52l6.732-6.168-5.292 3.216-2.244-.888c-.468-.18-.732-.696-.612-1.176.12-.48.564-.816 1.056-.828l8.688-.216c.372-.012.732.156.96.468z" />
      </svg>
    );
  }

  // WhatsApp
  if (lower.includes("wa.me") || lower.includes("whatsapp.com")) {
    return (
      <svg viewBox="0 0 24 24" fill="currentColor" className="w-4 h-4">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
      </svg>
    );
  }

  // Generic fallback
  return <LucideIcons.Globe className="w-4 h-4" />;
}



// ── Helpers ───────────────────────────────────────────────────────────
const API_BASE = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000";

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

// ── Component ─────────────────────────────────────────────────────
export default function Footer() {
  const { lang, dir } = useI18n();
  const [hoveredCompany, setHoveredCompany] = useState<string | null>(null);

  const [companies, setCompanies] = useState<Company[]>([]);
  const [settings, setSettings] = useState<SiteSettings | null>(null);

  const [loadingCompanies, setLoadingCompanies] = useState(true);
  const [loadingSettings, setLoadingSettings] = useState(true);

  // Fetch companies (existing API)
  useEffect(() => {
    const fetchCompanies = async () => {
      try {
        const res = await fetch(`${API_BASE}/api/companies?lang=${lang}`, {
          headers: { Accept: "application/json" },
        });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();
        if (json.success) setCompanies(json.data);
      } catch (err) {
        console.error("Footer: Failed to fetch companies:", err);
      } finally {
        setLoadingCompanies(false);
      }
    };
    fetchCompanies();
  }, [lang]);

  // Fetch site settings (NEW API - uses key-value site_settings + contact_infos)
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
        console.error("Footer: Failed to fetch site settings:", err);
      } finally {
        setLoadingSettings(false);
      }
    };
    fetchSettings();
  }, []);

  // Loading skeleton
  if (loadingSettings) {
    return (
      <footer className="relative bg-[#0A1628] overflow-hidden" dir={dir}>
        <div className="absolute top-0 left-0 right-0 h-px bg-[#C9A227]/20" />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
          <div className="animate-pulse grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
            <div className="lg:col-span-4 space-y-4">
              <div className="h-14 w-14 bg-white/5 rounded-xl" />
              <div className="h-4 w-48 bg-white/5 rounded" />
              <div className="h-3 w-full bg-white/5 rounded" />
              <div className="h-3 w-2/3 bg-white/5 rounded" />
            </div>
            <div className="lg:col-span-2 space-y-3">
              <div className="h-4 w-24 bg-white/5 rounded" />
              <div className="h-3 w-20 bg-white/5 rounded" />
              <div className="h-3 w-20 bg-white/5 rounded" />
              <div className="h-3 w-20 bg-white/5 rounded" />
            </div>
            <div className="lg:col-span-3 space-y-3">
              <div className="h-4 w-28 bg-white/5 rounded" />
              <div className="h-3 w-full bg-white/5 rounded" />
              <div className="h-3 w-full bg-white/5 rounded" />
            </div>
            <div className="lg:col-span-3 space-y-3">
              <div className="h-4 w-24 bg-white/5 rounded" />
              <div className="h-16 w-full bg-white/5 rounded-xl" />
              <div className="h-16 w-full bg-white/5 rounded-xl" />
            </div>
          </div>
        </div>
      </footer>
    );
  }

  if (!settings) {
    return (
      <footer className="relative bg-[#0A1628] py-12" dir={dir}>
        <div className="max-w-7xl mx-auto px-4 text-center">
          <p className="text-white/40 text-sm">Failed to load footer content.</p>
        </div>
      </footer>
    );
  }

  const brandTitle = getLocalizedText(lang, settings.brandTitleEn, settings.brandTitleDari, settings.brandTitlePashto);
  const brandSubtitle = getLocalizedText(lang, settings.brandSubtitleEn, settings.brandSubtitleDari, settings.brandSubtitlePashto);
  const brandDesc = getLocalizedText(lang, settings.brandDescEn, settings.brandDescDari, settings.brandDescPashto);
  const officeLabel = getLocalizedText(lang, settings.officeLabelEn, settings.officeLabelDari, settings.officeLabelPashto);
  const address = getLocalizedText(lang, settings.addressEn, settings.addressDari, settings.addressPashto);
  const phoneLabel = getLocalizedText(lang, settings.phoneLabelEn, settings.phoneLabelDari, settings.phoneLabelPashto);
  const emailLabel = getLocalizedText(lang, settings.emailLabelEn, settings.emailLabelDari, settings.emailLabelPashto);
  const copyright = getLocalizedText(lang, settings.copyrightEn, settings.copyrightDari, settings.copyrightPashto);
  const privacyText = getLocalizedText(lang, settings.privacyTextEn, settings.privacyTextDari, settings.privacyTextPashto);
  const termsText = getLocalizedText(lang, settings.termsTextEn, settings.termsTextDari, settings.termsTextPashto);

  const quickLinksTitle = lang === "en" ? "Quick Links" : lang === "dari" ? "لینک‌های سریع" : "چټک لینکونه";
  const ourCompaniesTitle = lang === "en" ? "Our Companies" : lang === "dari" ? "شرکت‌های ما" : "زموږ شرکتونه";
  const contactTitle = lang === "en" ? "Contact" : lang === "dari" ? "تماس" : "اړیکه";

  return (
    <footer className="relative bg-[#0A1628] overflow-hidden" dir={dir}>
      <div className="absolute top-0 left-0 right-0 h-px bg-[#C9A227]/20" />
      <div className="absolute top-0 left-1/4 w-96 h-96 bg-[#C9A227]/5 rounded-full blur-3xl -translate-y-1/2" />
      <div className="absolute bottom-0 right-1/4 w-96 h-96 bg-[#1A237E]/10 rounded-full blur-3xl translate-y-1/2" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">

          {/* ── Column 1: Brand (DYNAMIC from site_settings) ── */}
          <div className="lg:col-span-4 space-y-6">
            <Link href="/" className="inline-flex items-center gap-3 group">
              <div className="relative w-14 h-14 flex items-center justify-center">
                <div className="absolute inset-0 bg-[#C9A227] rounded-xl rotate-3 group-hover:rotate-6 transition-transform duration-300" />
                <div className="absolute inset-0 bg-[#0A1628] rounded-xl border-2 border-[#C9A227] flex items-center justify-center">
                  <span className="text-[#C9A227] font-bold text-xl">HGC</span>
                </div>
              </div>
              <div>
                <h2 className="text-white font-bold text-lg leading-tight">{brandTitle}</h2>
                <p className="text-[#C9A227] text-xs tracking-[0.2em] uppercase">{brandSubtitle}</p>
              </div>
            </Link>

            <p className="text-white/50 text-sm leading-relaxed max-w-xs">{brandDesc}</p>

            {/* Social Links (DYNAMIC from contact_infos or site_settings) */}


            <div className="flex items-center gap-3">
              {settings.socialLinks
                ?.filter((s) => s.is_active)
                .map((social) => (
                  <a
                    key={social.label}
                    href={social.url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-[#C9A227] hover:border-[#C9A227]/30 hover:bg-[#C9A227]/5 transition-all duration-300 group"
                    aria-label={social.label}
                  >
                    {getSocialIcon(social.url)}
                  </a>
                ))}
            </div>

          </div>

          {/* ── Column 2: Quick Links (DYNAMIC from site_settings JSON) ── */}
          <div className="lg:col-span-2">
            <h3 className="text-white font-semibold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
              <span className="w-1.5 h-1.5 rounded-full bg-[#C9A227]" />
              {quickLinksTitle}
            </h3>
            <ul className="space-y-2.5">
              {settings.footerLinks
                ?.sort((a, b) => a.sort_order - b.sort_order)
                .map((link) => (
                  <li key={link.href}>
                    <Link
                      href={link.href}
                      className="group flex items-center gap-2 text-white/50 hover:text-[#C9A227] transition-colors duration-200 text-sm"
                    >
                      <ChevronRight
                        className={`w-3.5 h-3.5 opacity-0 transition-all duration-200 ${dir === "rtl"
                          ? "-mr-5 group-hover:mr-0 group-hover:opacity-100 rotate-180"
                          : "-ml-5 group-hover:ml-0 group-hover:opacity-100"
                          }`}
                      />
                      {getLocalizedText(lang, link.label_en, link.label_dari, link.label_pashto)}
                    </Link>
                  </li>
                ))}
            </ul>
          </div>

          {/* ── Column 3: Companies (DYNAMIC - existing API) ── */}
          <div className="lg:col-span-3">
            <h3 className="text-white font-semibold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
              <span className="w-1.5 h-1.5 rounded-full bg-[#C9A227]" />
              {ourCompaniesTitle}
            </h3>
            {loadingCompanies ? (
              <div className="flex items-center justify-center py-4">
                <Loader2 className="w-5 h-5 text-[#C9A227] animate-spin" />
              </div>
            ) : companies.length === 0 ? (
              <p className="text-white/40 text-sm">
                {lang === "en" ? "No companies found." : lang === "dari" ? "هیچ شرکتی یافت نشد." : "هیڅ شرکت ونه موندل شو."}
              </p>
            ) : (
              <ul className="space-y-2">
                {companies.map((company) => {
                  // const Icon = companyIconMap[company.icon_name] || Building2;
                  const Icon = resolveCompanyIcon(company.icon_name);
                  const isHovered = hoveredCompany === company.slug;
                  return (
                    <li
                      key={company.slug}
                      onMouseEnter={() => setHoveredCompany(company.slug)}
                      onMouseLeave={() => setHoveredCompany(null)}
                    >
                      <Link
                        href={`/companies/${company.slug}`}
                        className="group flex items-center gap-3 p-2 -mx-2 rounded-xl hover:bg-white/5 transition-all duration-200"
                      >
                        <div
                          className="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-300"
                          style={{
                            backgroundColor: isHovered ? `${company.accent_color}25` : `${company.accent_color}10`,
                          }}
                        >
                          <Icon className="w-4 h-4 transition-colors duration-200" style={{ color: company.accent_color }} />
                        </div>
                        <span className="text-white/60 group-hover:text-white text-sm transition-colors flex-1">{company.name}</span>
                        <ArrowUpRight className={`w-3.5 h-3.5 transition-all duration-200 ${isHovered ? "text-[#C9A227] opacity-100" : "text-white/20 opacity-0"}`} />
                      </Link>
                    </li>
                  );
                })}
              </ul>
            )}
          </div>

          {/* ── Column 4: Contact (DYNAMIC from contact_infos table) ── */}
          <div className="lg:col-span-3">
            <h3 className="text-white font-semibold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
              <span className="w-1.5 h-1.5 rounded-full bg-[#C9A227]" />
              {contactTitle}
            </h3>

            <div className="space-y-4">
              {/* Address */}
              <div className="group p-4 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300">
                <div className="flex items-start gap-3">
                  <div className="w-9 h-9 rounded-lg bg-[#C9A227]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <MapPin className="w-4 h-4 text-[#C9A227]" />
                  </div>
                  <div>
                    <p className="text-white font-medium text-sm mb-1">{officeLabel}</p>
                    <p className="text-white/40 text-xs leading-relaxed">{address}</p>
                  </div>
                </div>
              </div>

              {/* Phone */}
              <div className="group p-4 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300">
                <div className="flex items-start gap-3">
                  <div className="w-9 h-9 rounded-lg bg-[#C9A227]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <Phone className="w-4 h-4 text-[#C9A227]" />
                  </div>
                  <div>
                    <p className="text-white font-medium text-sm mb-1">{phoneLabel}</p>
                    <a href={`tel:${settings.phonePrimary.replace(/\s/g, "")}`} className="text-white/40 text-xs hover:text-[#C9A227] transition-colors block">
                      {settings.phonePrimary}
                    </a>
                    {settings.phoneSecondary && (
                      <a href={`tel:${settings.phoneSecondary.replace(/\s/g, "")}`} className="text-white/40 text-xs hover:text-[#C9A227] transition-colors block">
                        {settings.phoneSecondary}
                      </a>
                    )}
                  </div>
                </div>
              </div>

              {/* Email */}
              <div className="group p-4 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300">
                <div className="flex items-start gap-3">
                  <div className="w-9 h-9 rounded-lg bg-[#C9A227]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <Mail className="w-4 h-4 text-[#C9A227]" />
                  </div>
                  <div>
                    <p className="text-white font-medium text-sm mb-1">{emailLabel}</p>
                    <a href={`mailto:${settings.emailAddress}`} className="text-white/40 text-xs hover:text-[#C9A227] transition-colors">
                      {settings.emailAddress}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* ── Bottom Bar (DYNAMIC) ── */}
        <div className="mt-12 pt-6 border-t border-white/5">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4">
            <p className="text-white/30 text-xs">{copyright}</p>
            <div className="flex items-center gap-6">
              <Link href="/privacy" className="text-white/30 hover:text-white/60 text-xs transition-colors">{privacyText}</Link>
              <Link href="/terms" className="text-white/30 hover:text-white/60 text-xs transition-colors">{termsText}</Link>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
}