"use client";

import { motion, useInView } from "framer-motion";
import { useRef, useEffect, useState } from "react";
import { useI18n } from "@/components/useI18nStore";
import { Building2, HardHat, Truck, Landmark, Mountain, Store, Users, Calendar } from "lucide-react";

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

interface CompanyStatsProps {
  company: {
    name: string;
    accent_color: string;
    details: {
      established_year: number | null;
      founded_year: number | null;
      employee_count: number | null;
      registration_number: string | null;
    };
  };
}

export default function CompanyStats({ company }: CompanyStatsProps) {
  const { lang, dir } = useI18n();
  const establishedYear = company.details.established_year || company.details.founded_year;

  const stats = [
    {
      icon: Building2,
      value: 1,
      suffix: "",
      label: lang === "en" ? "Company" : lang === "dari" ? "شرکت" : "شرکت",
    },
    {
      icon: HardHat,
      value: 50,
      suffix: "+",
      label: lang === "en" ? "Projects" : lang === "dari" ? "پروژه‌ها" : "پروژې",
    },
    {
      icon: Mountain,
      value: 34,
      suffix: "",
      label: lang === "en" ? "Provinces" : lang === "dari" ? "ولایت‌ها" : "ولایتونه",
    },
    {
      icon: Users,
      value: company.details.employee_count || 100,
      suffix: "+",
      label: lang === "en" ? "Employees" : lang === "dari" ? "کارمند" : "کارکوونکي",
    },
    {
      icon: Truck,
      value: 20,
      suffix: "+",
      label: lang === "en" ? "Vehicles" : lang === "dari" ? "وسایط" : "موټرونه",
    },
    {
      icon: Calendar,
      value: establishedYear ? new Date().getFullYear() - establishedYear : 10,
      suffix: "+",
      label: lang === "en" ? "Years" : lang === "dari" ? "سال" : "کالونه",
    },
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
              <div
                className="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl"
                style={{ backgroundColor: `${company.accent_color}15` }}
              >
                <stat.icon size={32} style={{ color: company.accent_color }} />
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