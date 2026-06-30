"use client";

import { motion, useInView } from "framer-motion";
import { useRef, useEffect, useState } from "react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { Building2, HardHat, Truck, Landmark, Mountain, Store } from "lucide-react";

function AnimatedCounter({ target, suffix = "" }: { target: number; suffix?: string }) {
  const [count, setCount] = useState(0);
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true });

  useEffect(() => {
    if (!isInView) return;
    let start = 0;
    const duration = 2000;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
      start += increment;
      if (start >= target) {
        setCount(target);
        clearInterval(timer);
      } else {
        setCount(Math.floor(start));
      }
    }, 16);
    return () => clearInterval(timer);
  }, [isInView, target]);

  return (
    <span ref={ref}>
      {count}
      {suffix}
    </span>
  );
}

export default function CompanyStats() {
  const { lang, dir } = useI18n();

  const stats = [
    { icon: Building2, value: 6, suffix: "", label: t(lang, "profile.stat_companies") },
    { icon: HardHat, value: 500, suffix: "+", label: t(lang, "profile.stat_projects") },
    { icon: Mountain, value: 34, suffix: "", label: t(lang, "profile.stat_provinces") },
    { icon: Users, value: 2500, suffix: "+", label: t(lang, "profile.stat_employees") },
    { icon: Truck, value: 150, suffix: "+", label: t(lang, "profile.stat_vehicles") },
    { icon: Landmark, value: 25, suffix: "+", label: t(lang, "profile.stat_years") },
  ];

  return (
    <section className="py-20 bg-[#070F1A]" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={{
            hidden: { opacity: 0 },
            visible: { opacity: 1, transition: { staggerChildren: 0.1 } },
          }}
          className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6"
        >
          {stats.map((stat) => (
            <motion.div
              key={stat.label}
              variants={{
                hidden: { opacity: 0, y: 20 },
                visible: { opacity: 1, y: 0 },
              }}
              className="text-center"
            >
              <div className="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#C9A227]/15 text-[#C9A227]">
                <stat.icon size={32} />
              </div>
              <p className="text-3xl font-bold text-white mb-1">
                <AnimatedCounter target={stat.value} suffix={stat.suffix} />
              </p>
              <p className="text-sm text-white/50">{stat.label}</p>
            </motion.div>
          ))}
        </motion.div>
      </div>
    </section>
  );
}

import { Users } from "lucide-react";