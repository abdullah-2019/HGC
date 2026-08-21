"use client";

import { useState } from "react";
import { Building2, Mountain, HardHat, Store, Landmark, Truck } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const iconMap: Record<string, React.ElementType> = {
  Building2,
  Mountain,
  HardHat,
  Store,
  Landmark,
  Truck,
  Pickaxe: Mountain,
  Wrench: HardHat,
  Sun: Landmark,
  Fuel: Truck,
  Gem: Mountain,
  default: Building2,
};

interface CompanyFilterProps {
  activeCompany: string;
  onCompanyChange: (company: string) => void;
  companies: any[];
}

/** Logo-first renderer: shows the company logo image if available;
 *  falls back to the mapped Lucide icon on missing URL or load error. */
function CompanyIcon({
  company,
  isActive,
}: {
  company: any;
  isActive: boolean;
}) {
  const [imgError, setImgError] = useState(false);
  const Icon = iconMap[company.icon] || iconMap.default;

  // No logo or image failed → show icon
  if (!company.logo || imgError) {
    return (
      <Icon
        className="w-4 h-4 shrink-0"
        style={{ color: isActive ? company.color : "currentColor" }}
      />
    );
  }

  // Logo available → show image
  return (
    <img
      src={company.logo}
      alt={company.short_name_en || ""}
      className="w-5 h-5 object-contain shrink-0 rounded"
      loading="lazy"
      onError={() => setImgError(true)}
    />
  );
}

export default function CompanyFilter({
  activeCompany,
  onCompanyChange,
  companies,
}: CompanyFilterProps) {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";

  const allOption = {
    id: "all",
    slug: "all",
    short_name_en: "All Projects",
    short_name_dari: "همه پروژه‌ها",
    short_name_pashto: "ټولې پروژې",
    icon: "Building2",
    color: "#D4AF37",
    logo: null,
  };

  const filterCompanies = [allOption, ...companies];

  const getName = (company: any) => {
    if (lang === "en") return company.short_name_en || "Unknown";
    if (lang === "dari")
      return company.short_name_dari || company.short_name_en || "Unknown";
    return (
      company.short_name_pashto ||
      company.short_name_dari ||
      company.short_name_en ||
      "Unknown"
    );
  };

  return (
    <section
      dir={isRtl ? "rtl" : "ltr"}
      className="relative py-8 bg-hgc-bg border-b border-hgc-border sticky top-0 z-40 backdrop-blur-xl"
    >
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
          {filterCompanies.map((company) => {
            const isActive = activeCompany === company.slug;

            return (
              <button
                key={company.id}
                onClick={() => onCompanyChange(company.slug)}
                className={`flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium whitespace-nowrap transition-all duration-300 ${
                  isActive
                    ? "text-hgc-navy shadow-lg"
                    : "text-hgc-text-muted hover:text-hgc-text-secondary hover:bg-hgc-surface-elevated"
                }`}
                style={{
                  backgroundColor: isActive
                    ? `${company.color}18`
                    : "transparent",
                  borderColor: isActive
                    ? `${company.color}40`
                    : "transparent",
                  borderWidth: "1px",
                  boxShadow: isActive
                    ? `0 4px 20px ${company.color}12`
                    : "none",
                }}
              >
                <CompanyIcon company={company} isActive={isActive} />
                <span>{getName(company)}</span>
                {isActive && (
                  <span
                    className="w-1.5 h-1.5 rounded-full animate-pulse shrink-0"
                    style={{ backgroundColor: company.color }}
                  />
                )}
              </button>
            );
          })}
        </div>
      </div>

      <style jsx>{`
        .scrollbar-hide::-webkit-scrollbar {
          display: none;
        }
        .scrollbar-hide {
          -ms-overflow-style: none;
          scrollbar-width: none;
        }
      `}</style>
    </section>
  );
}