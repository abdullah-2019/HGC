"use client";

import Link from "next/link";
import { useState, useEffect } from "react";
import { Building2, Mountain, HardHat, Store, Landmark, Truck, ArrowRight } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

// Icon mapping for dynamic rendering
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

export default function CompaniesSection() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const [companies, setCompanies] = useState<Company[]>([]);
  const [loading, setLoading] = useState(true);
  const [hoveredCompany, setHoveredCompany] = useState<string | null>(null);
  const [brokenLogos, setBrokenLogos] = useState<Set<string>>(new Set());

  useEffect(() => {
    const fetchCompanies = async () => {
      try {
        const res = await fetch(
          `${process.env.NEXT_PUBLIC_API_URL}/api/companies?lang=${lang}`
        );
        const json = await res.json();
        if (json.success) {
          setCompanies(json.data);
        }
      } catch (err) {
        console.error("Failed to fetch companies:", err);
      } finally {
        setLoading(false);
      }
    };

    fetchCompanies();
  }, [lang]);

  const handleLogoError = (slug: string) => {
    setBrokenLogos((prev) => {
      const next = new Set(prev);
      next.add(slug);
      return next;
    });
  };

  if (loading) {
    return (
      <section className="py-24 bg-hgc-companies-bg">
        <div className="max-w-7xl mx-auto px-4 text-center">
          <div className="animate-pulse text-hgc-companies-text-secondary">Loading companies...</div>
        </div>
      </section>
    );
  }

  return (
    <section dir={isRtl ? "rtl" : "ltr"} className="py-24 relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--color-hgc-companies-gold)/5_0%,_transparent_50%)]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="text-center mb-16">
          <span className="inline-block px-4 py-1 rounded-full bg-hgc-companies-gold/10 text-hgc-companies-gold text-sm font-medium mb-4">
            {lang === "en" ? "Our Group" : lang === "dari" ? "گروپ ما" : "زموږ ګروپ"}
          </span>
          <h2 className="text-4xl lg:text-5xl font-bold text-hgc-companies-text mb-4">
            {lang === "en" ? (
              <>
                Six Specialized <span className="text-hgc-companies-gold">Companies</span>
              </>
            ) : lang === "dari" ? (
              <>
                شش شرکت <span className="text-hgc-companies-gold">تخصصی</span>
              </>
            ) : (
              <>
                شپږ <span className="text-hgc-companies-gold">تخصصي</span> شرکتونه
              </>
            )}
          </h2>
          <p className="text-hgc-companies-text-secondary max-w-2xl mx-auto">
            {lang === "en"
              ? "Each company brings unique expertise to deliver comprehensive solutions across Afghanistan."
              : lang === "dari"
                ? "هر شرکت تخصص منحصر به فردی را برای ارائه راه حل های جامع در سراسر افغانستان به ارمغان می آورد."
                : "هر شرکت ځانګړې مهارت راوړي ترڅو په افغانستان کې جامع حلونه وړاندې کړي."}
          </p>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {companies.map((company) => {
            const Icon = iconMap[company.icon_name] || Building2;
            const isHovered = hoveredCompany === company.slug;
            const showLogo =
              company.logo_url && !brokenLogos.has(company.slug);

            return (
              <Link
                key={company.slug}
                href={`/companies/${company.slug}`}
                onMouseEnter={() => setHoveredCompany(company.slug)}
                onMouseLeave={() => setHoveredCompany(null)}
                className="group relative bg-hgc-companies-card-bg border border-hgc-companies-card-border rounded-2xl p-6 hover:bg-hgc-companies-card-hover hover:border-hgc-companies-card-border transition-all duration-500 overflow-hidden"
              >
                <div
                  className="absolute top-0 left-0 right-0 h-1 rounded-t-2xl transition-all duration-500"
                  style={{
                    backgroundColor: isHovered ? company.accent_color : "transparent",
                    opacity: isHovered ? 1 : 0,
                  }}
                />
                <div className="flex items-start gap-4">
                  <div
                    className="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-500 overflow-hidden"
                    style={{
                      backgroundColor: isHovered
                        ? `${company.accent_color}25`
                        : `${company.accent_color}10`,
                    }}
                  >
                    {showLogo ? (
                      <img
                        src={company.logo_url!}
                        alt={company.name}
                        className="w-10 h-10 object-contain"
                        onError={() => handleLogoError(company.slug)}
                      />
                    ) : (
                      <Icon
                        className="w-7 h-7 transition-colors duration-300"
                        style={{ color: company.accent_color }}
                      />
                    )}
                  </div>
                  <div className="flex-1 min-w-0">
                    <h3 className="text-hgc-companies-text font-bold text-lg mb-1 group-hover:text-hgc-companies-gold transition-colors">
                      {company.name}
                    </h3>
                    <p className="text-hgc-companies-text-muted text-sm mb-3">
                      {company.description}
                    </p>
                    <span className="inline-flex items-center gap-1 text-sm text-hgc-companies-gold/70 group-hover:text-hgc-companies-gold transition-colors">
                      {t(lang, "common.visit")}
                      <ArrowRight
                        className={`w-4 h-4 transition-transform ${
                          isRtl
                            ? "rotate-180 group-hover:-translate-x-1"
                            : "group-hover:translate-x-1"
                        }`}
                      />
                    </span>
                  </div>
                </div>
              </Link>
            );
          })}
        </div>
      </div>
    </section>
  );
}