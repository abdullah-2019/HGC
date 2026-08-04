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
      <section className="py-20 bg-hgc-bg border-y border-hgc-border">
        <div className="max-w-7xl mx-auto px-4 flex items-center justify-center">
          <Loader2 className="w-8 h-8 text-hgc-gold animate-spin" />
        </div>
      </section>
    );
  }

  return (
    <section className="py-20 bg-hgc-bg border-y border-hgc-border">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <span className="inline-block px-4 py-1 rounded-full bg-hgc-gold/10 text-hgc-gold text-sm font-medium mb-4">
            {lang === "en"
              ? "Business Verticals"
              : lang === "dari"
                ? "حوزه های کاری"
                : "د سوداګرۍ عمودي"}
          </span>
          <h2 className="text-3xl lg:text-4xl font-bold text-hgc-text mb-4">
            {lang === "en" ? (
              <>
                Our <span className="text-hgc-gold">Sectors</span>
              </>
            ) : lang === "dari" ? (
              <>
                <span className="text-hgc-gold">حوزه‌های</span> کاری ما
              </>
            ) : (
              <>
                زموږ <span className="text-hgc-gold">سکتورونه</span>
              </>
            )}
          </h2>
          <p className="text-hgc-text-secondary max-w-2xl mx-auto text-lg">
            {lang === "en"
              ? "Mining, Construction, Energy, and General Trading solutions driving sustainable growth across Afghanistan."
              : lang === "dari"
                ? "راه حل های استخراج معادن، ساخت و ساز، انرژی و تجارت عمومی که رشد پایدار را در سراسر افغانستان هدایت می کنند."
                : "د کانونو استخراج، جوړونه، انرژي، او عمومي سوداګرۍ حلونه چې په افغانستان کې د پایدار ودې هدایت کوي."}
          </p>
        </div>

        {sectors.length === 0 ? (
          <div className="text-center text-hgc-text-muted py-8">
            {lang === "en"
              ? "No sectors found."
              : lang === "dari"
                ? "هیچ حوزه کاری یافت نشد."
                : "هیڅ سکتور ونه موندل شو."}
          </div>
        ) : (
          <div className="flex flex-wrap justify-center gap-4">
            {sectors.map((sector) => {
              const Icon = iconMap[sector.icon_name] || Road;
              return (
                <Link
                  key={sector.slug}
                  href={`/sectors/${sector.slug}`}
                  className="group text-center p-6 rounded-2xl bg-hgc-card-alt border border-hgc-border hover:bg-hgc-card-hover hover:border-hgc-gold/20 transition-all duration-300 w-36 sm:w-40 lg:w-44"
                >
                  <div className="w-12 h-12 mx-auto rounded-xl bg-hgc-gold/10 flex items-center justify-center mb-3 group-hover:bg-hgc-gold/20 group-hover:scale-110 transition-all duration-300">
                    <Icon className="w-6 h-6 text-hgc-gold" />
                  </div>
                  <p className="text-hgc-text font-medium text-sm mb-1 group-hover:text-hgc-gold transition-colors">
                    {sector.name}
                  </p>
                  <p className="text-hgc-gold text-xs font-bold">
                    {sector.projects_count}+
                  </p>
                </Link>
              );
            })}
          </div>
        )}
      </div>
    </section>
  );
}