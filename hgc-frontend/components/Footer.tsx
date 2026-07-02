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
  Globe,
  MessageCircle,
  ArrowUpRight,
  ChevronRight,
  Users,
  Loader2,
} from "lucide-react";
import { useI18n } from "./useI18nStore";
import { t } from "./translations";

// Icon mapping for dynamic rendering from API
const iconMap: Record<string, React.ElementType> = {
  Building2,
  Mountain,
  HardHat,
  Store,
  Landmark,
  Truck,
};

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

const quickLinks = [
  { href: "/about", key: "nav.about" },
  { href: "/projects", key: "nav.projects" },
  { href: "/media", key: "nav.media" },
  { href: "/products", key: "nav.products" },
  { href: "/contact", key: "nav.contact" },
];

export default function Footer() {
  const { lang, dir } = useI18n();
  const [hoveredCompany, setHoveredCompany] = useState<string | null>(null);
  const [companies, setCompanies] = useState<Company[]>([]);
  const [loadingCompanies, setLoadingCompanies] = useState(true);

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
        console.error("Footer: Failed to fetch companies:", err);
        setCompanies([]);
      } finally {
        setLoadingCompanies(false);
      }
    };

    fetchCompanies();
  }, [lang]);

  return (
    <footer className="relative bg-[#0A1628] overflow-hidden" dir={dir}>
      {/* Decorative */}
      <div className="absolute top-0 left-0 right-0 h-px bg-[#C9A227]/20" />
      <div className="absolute top-0 left-1/4 w-96 h-96 bg-[#C9A227]/5 rounded-full blur-3xl -translate-y-1/2" />
      <div className="absolute bottom-0 right-1/4 w-96 h-96 bg-[#1A237E]/10 rounded-full blur-3xl translate-y-1/2" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
          {/* Column 1: Brand */}
          <div className="lg:col-span-4 space-y-6">
            <Link href="/" className="inline-flex items-center gap-3 group">
              <div className="relative w-14 h-14 flex items-center justify-center">
                <div className="absolute inset-0 bg-[#C9A227] rounded-xl rotate-3 group-hover:rotate-6 transition-transform duration-300" />
                <div className="absolute inset-0 bg-[#0A1628] rounded-xl border-2 border-[#C9A227] flex items-center justify-center">
                  <span className="text-[#C9A227] font-bold text-xl">HGC</span>
                </div>
              </div>
              <div>
                <h2 className="text-white font-bold text-lg leading-tight">
                  {t(lang, "footer.brandTitle")}
                </h2>
                <p className="text-[#C9A227] text-xs tracking-[0.2em] uppercase">
                  {t(lang, "footer.brandSubtitle")}
                </p>
              </div>
            </Link>

            <p className="text-white/50 text-sm leading-relaxed max-w-xs">
              {t(lang, "footer.brandDesc")}
            </p>

            <div className="flex items-center gap-3">
              {[
                { icon: Globe, label: "Website", href: "#" },
                { icon: Users, label: "Social", href: "#" },
                { icon: MessageCircle, label: "WhatsApp", href: "#" },
                { icon: Mail, label: "Email", href: "mailto:info@hcrc-af.com" },
              ].map((social) => {
                const Icon = social.icon;
                return (
                  <a
                    key={social.label}
                    href={social.href}
                    className="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:text-[#C9A227] hover:border-[#C9A227]/30 hover:bg-[#C9A227]/5 transition-all duration-300 group"
                    aria-label={social.label}
                  >
                    <Icon className="w-4 h-4 group-hover:scale-110 transition-transform" />
                  </a>
                );
              })}
            </div>
          </div>

          {/* Column 2: Quick Links */}
          <div className="lg:col-span-2">
            <h3 className="text-white font-semibold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
              <span className="w-1.5 h-1.5 rounded-full bg-[#C9A227]" />
              {t(lang, "footer.quickLinks")}
            </h3>
            <ul className="space-y-2.5">
              {quickLinks.map((link) => (
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
                    {t(lang, link.key)}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Column 3: Companies (from API) */}
          <div className="lg:col-span-3">
            <h3 className="text-white font-semibold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
              <span className="w-1.5 h-1.5 rounded-full bg-[#C9A227]" />
              {t(lang, "footer.ourCompanies")}
            </h3>
            {loadingCompanies ? (
              <div className="flex items-center justify-center py-4">
                <Loader2 className="w-5 h-5 text-[#C9A227] animate-spin" />
              </div>
            ) : companies.length === 0 ? (
              <p className="text-white/40 text-sm">
                {lang === "en"
                  ? "No companies found."
                  : lang === "dari"
                    ? "هیچ شرکتی یافت نشد."
                    : "هیڅ شرکت ونه موندل شو."}
              </p>
            ) : (
              <ul className="space-y-2">
                {companies.map((company) => {
                  const Icon = iconMap[company.icon_name] || Building2;
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
                            backgroundColor: isHovered
                              ? `${company.accent_color}25`
                              : `${company.accent_color}10`,
                          }}
                        >
                          <Icon
                            className="w-4 h-4 transition-colors duration-200"
                            style={{ color: company.accent_color }}
                          />
                        </div>
                        <span className="text-white/60 group-hover:text-white text-sm transition-colors flex-1">
                          {company.name}
                        </span>
                        <ArrowUpRight
                          className={`w-3.5 h-3.5 transition-all duration-200 ${isHovered
                              ? "text-[#C9A227] opacity-100"
                              : "text-white/20 opacity-0"
                            }`}
                        />
                      </Link>
                    </li>
                  );
                })}
              </ul>
            )}
          </div>

          {/* Column 4: Contact */}
          <div className="lg:col-span-3">
            <h3 className="text-white font-semibold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
              <span className="w-1.5 h-1.5 rounded-full bg-[#C9A227]" />
              {t(lang, "footer.contact")}
            </h3>

            <div className="space-y-4">
              {/* Address */}
              <div className="group p-4 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300">
                <div className="flex items-start gap-3">
                  <div className="w-9 h-9 rounded-lg bg-[#C9A227]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <MapPin className="w-4 h-4 text-[#C9A227]" />
                  </div>
                  <div>
                    <p className="text-white font-medium text-sm mb-1">
                      {t(lang, "footer.kabulOffice")}
                    </p>
                    <p className="text-white/40 text-xs leading-relaxed">
                      {t(lang, "footer.address")}
                    </p>
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
                    <p className="text-white font-medium text-sm mb-1">
                      {t(lang, "footer.phone")}
                    </p>
                    <a
                      href="tel:+93711111694"
                      className="text-white/40 text-xs hover:text-[#C9A227] transition-colors block"
                    >
                      +93 (0) 711 111 694
                    </a>
                    <a
                      href="tel:+93703420311"
                      className="text-white/40 text-xs hover:text-[#C9A227] transition-colors block"
                    >
                      +93 (0) 703 420 311xxx
                    </a>
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
                    <p className="text-white font-medium text-sm mb-1">
                      {t(lang, "footer.email")}
                    </p>
                    <a
                      href="mailto:info@hcrc-af.com"
                      className="text-white/40 text-xs hover:text-[#C9A227] transition-colors"
                    >
                      info@hcrc-af.com
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="mt-12 pt-6 border-t border-white/5">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4">
            <p className="text-white/30 text-xs">
              {t(lang, "footer.copyright")}
            </p>
            <div className="flex items-center gap-6">
              <Link
                href="/privacy"
                className="text-white/30 hover:text-white/60 text-xs transition-colors"
              >
                {t(lang, "footer.privacyPolicy")}
              </Link>
              <Link
                href="/terms"
                className="text-white/30 hover:text-white/60 text-xs transition-colors"
              >
                {t(lang, "footer.termsOfService")}
              </Link>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
}