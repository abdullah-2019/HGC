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
const companyIconMap: Record<string, React.ElementType> = {
  Building2, Mountain, HardHat, Store, Landmark, Truck,
};

function resolveIcon(iconName: string): LucideIcon {
  const Icon = (LucideIcons as Record<string, unknown>)[iconName];
  return (Icon as LucideIcon) || LucideIcons.Globe;
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
                .map((social) => {
                  const Icon = resolveIcon(social.icon);
                  return (
                    <a
                      key={social.label}
                      href={social.url}
                      className="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-[#C9A227] hover:border-[#C9A227]/30 hover:bg-[#C9A227]/5 transition-all duration-300 group"
                      aria-label={social.label}
                    >
                      <Icon className="w-4 h-4 group-hover:scale-110 transition-transform" />
                    </a>
                  );
                })}
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
                        className={`w-3.5 h-3.5 opacity-0 transition-all duration-200 ${
                          dir === "rtl"
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
                  const Icon = companyIconMap[company.icon_name] || Building2;
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