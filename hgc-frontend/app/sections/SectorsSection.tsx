"use client";

import { useState, useEffect } from "react";
import {
  Road,
  Home,
  Mountain,
  Zap,
  Sun,
  Truck,
  Loader2,
  ArrowRight,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import Link from "next/link";

const iconMap: Record<string, React.ElementType> = {
  Road,
  Home,
  Mountain,
  Zap,
  Sun,
  Truck,
};

interface Sector {
  id: number;
  slug: string;
  name: string;
  description: string | null;
  icon_name: string;
  projects_count: number;
  image_url: string | null;
}

export default function SectorsSection() {
  const { lang } = useI18n();
  const [sectors, setSectors] = useState<Sector[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchSectors = async () => {
      try {
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/sectors?lang=${lang}`;
        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
        });

        if (!res.ok) throw new Error(`HTTP ${res.status}`);

        const contentType = res.headers.get("content-type");
        if (!contentType?.includes("application/json")) {
          const text = await res.text();
          throw new Error(`Expected JSON, got: ${text.substring(0, 100)}`);
        }

        const json = await res.json();
        if (json.success) {
          setSectors(json.data);
        }
      } catch (err) {
        console.error("Sectors fetch error:", err);
        setSectors([]);
      } finally {
        setLoading(false);
      }
    };

    fetchSectors();
  }, [lang]);

  if (loading) {
    return (
      <section className="py-20 bg-[#0A1628] border-y border-white/5">
        <div className="max-w-7xl mx-auto px-4 flex items-center justify-center">
          <Loader2 className="w-8 h-8 text-[#C9A227] animate-spin" />
        </div>
      </section>
    );
  }

  return (
    <section className="py-20 bg-[#0A1628] border-y border-white/5">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
            {lang === "en"
              ? "Business Verticals"
              : lang === "dari"
              ? "حوزه های کاری"
              : "د سوداګرۍ عمودي"}
          </span>
          <h2 className="text-3xl lg:text-4xl font-bold text-white mb-4">
            {lang === "en" ? (
              <>
                Our <span className="text-[#C9A227]">Sectors</span>
              </>
            ) : lang === "dari" ? (
              <>
                <span className="text-[#C9A227]">حوزه‌های</span> کاری ما
              </>
            ) : (
              <>
                زموږ <span className="text-[#C9A227]">سکتورونه</span>
              </>
            )}
          </h2>
          <p className="text-white/50 max-w-2xl mx-auto text-lg">
            {lang === "en"
              ? "Mining, Construction, Energy, and General Trading solutions driving sustainable growth across Afghanistan."
              : lang === "dari"
              ? "راه حل های استخراج معادن، ساخت و ساز، انرژی و تجارت عمومی که رشد پایدار را در سراسر افغانستان هدایت می کنند."
              : "د کانونو استخراج، جوړونه، انرژي، او عمومي سوداګرۍ حلونه چې په افغانستان کې د پایدار ودې هدایت کوي."}
          </p>
        </div>

        {sectors.length === 0 ? (
          <div className="text-center text-white/40 py-8">
            {lang === "en"
              ? "No sectors found."
              : lang === "dari"
              ? "هیچ حوزه کاری یافت نشد."
              : "هیڅ سکتور ونه موندل شو."}
          </div>
        ) : (
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            {sectors.map((sector) => {
              const Icon = iconMap[sector.icon_name] || Road;
              return (
                <Link
                  key={sector.slug}
                  href={`/sectors/${sector.slug}`}
                  className="group text-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.05] hover:border-[#C9A227]/20 transition-all duration-300"
                >
                  <div className="w-12 h-12 mx-auto rounded-xl bg-[#C9A227]/10 flex items-center justify-center mb-3 group-hover:bg-[#C9A227]/20 group-hover:scale-110 transition-all duration-300">
                    <Icon className="w-6 h-6 text-[#C9A227]" />
                  </div>
                  <p className="text-white font-medium text-sm mb-1 group-hover:text-[#C9A227] transition-colors">
                    {sector.name}
                  </p>
                  <p className="text-[#C9A227] text-xs font-bold">
                    {sector.projects_count}+
                  </p>
                </Link>
              );
            })}
          </div>
        )}

        {/* Optional: View All Link */}
        <div className="text-center mt-10">
          <Link
            href="/sectors"
            className="inline-flex items-center gap-2 text-[#C9A227]/70 hover:text-[#C9A227] text-sm font-medium transition-colors group"
          >
            {lang === "en"
              ? "View All Sectors"
              : lang === "dari"
              ? "مشاهده همه حوزه‌ها"
              : "ټول سکتورونه وګورئ"}
            <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
          </Link>
        </div>
      </div>
    </section>
  );
}