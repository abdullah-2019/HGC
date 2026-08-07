"use client";

import { Building2, Mountain, HardHat, Store, Landmark, Truck } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

// Icon mapping
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

export default function CompanyFilter({ activeCompany, onCompanyChange, companies }: CompanyFilterProps) {
  const { lang } = useI18n();

  // Fallback if API companies not loaded yet
  const filterCompanies = companies.length > 0 ? companies : [
    { id: "all", slug: "all", nameEn: "All Projects", nameDari: "همه پروژه‌ها", icon: "Building2", color: "#D4AF37" },
    { id: "hcrc", slug: "hcrc", nameEn: "Hafez Construction", nameDari: "حافظ ساختمان", icon: "Building2", color: "#B22222" },
    { id: "albahrain", slug: "albahrain", nameEn: "Al-Bahrain Mining", nameDari: "البحرین معادن", icon: "Mountain", color: "#1A237E" },
    { id: "zainnoorain", slug: "zainnoorain", nameEn: "Zain Noorain", nameDari: "زین نورین", icon: "HardHat", color: "#F57C00" },
    { id: "almadinah", slug: "almadinah", nameEn: "Al-Madinah Trading", nameDari: "المدینه تجارت", icon: "Store", color: "#2E7D32" },
    { id: "haramain", slug: "haramain", nameEn: "Haramain Financial", nameDari: "حرمین مالی", icon: "Landmark", color: "#FFD700" },
    { id: "alkoozi", slug: "alkoozi", nameEn: "Al-Koozi Logistics", nameDari: "الکوزی لوجستیک", icon: "Truck", color: "#00838F" },
  ];

  return (
    <section className="relative py-8 bg-hgc-bg border-b border-hgc-border sticky top-0 z-40 backdrop-blur-xl">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
          {filterCompanies.map((company) => {
            const Icon = iconMap[company.icon] || iconMap.default;
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
                  backgroundColor: isActive ? `${company.color}18` : "transparent",
                  borderColor: isActive ? `${company.color}40` : "transparent",
                  borderWidth: "1px",
                  boxShadow: isActive ? `0 4px 20px ${company.color}12` : "none",
                }}
              >
                <Icon
                  className="w-4 h-4"
                  style={{ color: isActive ? company.color : "currentColor" }}
                />
                <span>{lang === "en" ? company.nameEn : company.nameDari}</span>
                {isActive && (
                  <span
                    className="w-1.5 h-1.5 rounded-full animate-pulse"
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