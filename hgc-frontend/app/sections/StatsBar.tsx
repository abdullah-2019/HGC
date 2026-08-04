"use client";

import { useState, useEffect, useRef, useCallback } from "react";
import {
  Clock,
  Briefcase,
  MapPin,
  Building2,
  Loader2,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const iconMap: Record<string, React.ElementType> = {
  Clock,
  Briefcase,
  MapPin,
  Building2,
};

interface Stat {
  id: number;
  key: string;
  value: number;
  suffix: string;
  label: string;
  icon_name: string;
}

// Individual stat item component — each has its own useCountUp hook
function StatItem({ stat }: { stat: Stat }) {
  const [count, setCount] = useState(0);
  const [hasStarted, setHasStarted] = useState(false);
  const ref = useRef<HTMLDivElement>(null);
  const Icon = iconMap[stat.icon_name] || Building2;

  // Intersection Observer to trigger animation
  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !hasStarted) {
          setHasStarted(true);
        }
      },
      { threshold: 0.3 }
    );

    if (ref.current) {
      observer.observe(ref.current);
    }

    return () => observer.disconnect();
  }, [hasStarted]);

  // Count-up animation
  useEffect(() => {
    if (!hasStarted) return;

    let start = 0;
    const duration = 2000;
    const increment = stat.value / (duration / 16);
    const timer = setInterval(() => {
      start += increment;
      if (start >= stat.value) {
        setCount(stat.value);
        clearInterval(timer);
      } else {
        setCount(Math.floor(start));
      }
    }, 16);

    return () => clearInterval(timer);
  }, [hasStarted, stat.value]);

  return (
    <div ref={ref} className="text-center group">
      <div className="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#C9A227]/10 mb-4 group-hover:bg-[#C9A227]/20 transition-colors">
        <Icon className="w-7 h-7 text-[#C9A227]" />
      </div>
      <div className="text-4xl lg:text-5xl font-bold text-[#0F172A] mb-2">
        {count}
        <span className="text-[#C9A227]">{stat.suffix}</span>
      </div>
      <p className="text-[#0F172A]/50 text-sm">{stat.label}</p>
    </div>
  );
}

export default function StatsBar() {
  const { lang } = useI18n();
  const [stats, setStats] = useState<Stat[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchStats = async () => {
      try {
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/stats?lang=${lang}`;
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
          setStats(json.data);
        }
      } catch (err) {
        console.error("Stats fetch error:", err);
        setStats([]);
      } finally {
        setLoading(false);
      }
    };

    fetchStats();
  }, [lang]);

  if (loading) {
    return (
      <section className="relative py-16 bg-white border-y border-[#E2E8F0]">
        <div className="max-w-7xl mx-auto px-4 flex items-center justify-center min-h-[200px]">
          <Loader2 className="w-8 h-8 text-[#C9A227] animate-spin" />
        </div>
      </section>
    );
  }

  return (
    <section className="relative py-16 bg-white border-y border-[#E2E8F0]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-8">
          {stats.map((stat) => (
            <StatItem key={stat.key} stat={stat} />
          ))}
        </div>
      </div>
    </section>
  );
}