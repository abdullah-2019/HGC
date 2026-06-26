"use client";

import Link from "next/link";
import { Package, CheckCircle2, ArrowRight, Pickaxe, Wrench, Road, Sun, Hammer, Container } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const featuredProducts = [
  {
    id: 1,
    name: "Crushed Stone Aggregate",
    nameDari: "سنگدانه خرد شده",
    namePashto: "مات شوي ډبرې",
    category: "Mining",
    categoryDari: "استخراج معادن",
    icon: Pickaxe,
    description: "High-quality crushed stone for construction and road building, sourced from our own quarries.",
    descriptionDari: "سنگ خرد شده با کیفیت بالا برای ساخت و ساز و ساخت سرک، از معادن خود ما.",
    specs: ["Various sizes: 0-5mm, 5-10mm, 10-20mm", "High compressive strength", "Available in bulk quantities"],
  },
  {
    id: 2,
    name: "Ready-Mix Concrete",
    nameDari: "بتن آماده",
    namePashto: "چمتو شوی کنکریټ",
    category: "Construction",
    categoryDari: "ساختمان",
    icon: Wrench,
    description: "Premium ready-mix concrete delivered to your site with consistent quality and timely supply.",
    descriptionDari: "بتن آماده با کیفیت بالا به سایت شما تحویل داده می شود با کیفیت ثابت و تدارک به موقع.",
    specs: ["Grade M15 to M50", "On-site pumping available", "24/7 batching plant operation"],
  },
  {
    id: 3,
    name: "Bitumen & Asphalt",
    nameDari: "قیر و آسفالت",
    namePashto: "بیټومین او اسفالټ",
    category: "Roads",
    categoryDari: "سرک",
    icon: Road,
    description: "Industrial-grade bitumen and asphalt products for highway and road surfacing projects.",
    descriptionDari: "محصولات قیر و آسفالت درجه صنعتی برای پروژه های سطح سرک و بزرگراه.",
    specs: ["Penetration grades: 60/70, 80/100", "Cutback and emulsion types", "Bulk and drum packaging"],
  },
  {
    id: 4,
    name: "Solar Power Systems",
    nameDari: "سیستم های برق خورشیدی",
    namePashto: "د سولري برق سیسټمونه",
    category: "Energy",
    categoryDari: "انرژی",
    icon: Sun,
    description: "Complete solar power solutions from 5kW to 500kW for residential, commercial, and industrial use.",
    descriptionDari: "راه حل های کامل برق خورشیدی از ۵ کیلووات تا ۵۰۰ کیلووات برای استفاده مسکونی، تجاری و صنعتی.",
    specs: ["Tier-1 solar panels", "MPPT charge controllers", "Lithium battery storage"],
  },
  {
    id: 5,
    name: "Construction Equipment Rental",
    nameDari: "اجاره تجهیزات ساختمانی",
    namePashto: "د جوړونې تجهیزات کرایه",
    category: "Equipment",
    categoryDari: "تجهیزات",
    icon: Hammer,
    description: "Modern construction machinery and equipment rental with trained operators and maintenance support.",
    descriptionDari: "اجاره ماشین آلات و تجهیزات ساختمانی مدرن با اپراتورهای آموزش دیده و پشتیبانی نگهداری.",
    specs: ["Excavators, bulldozers, cranes", "Dump trucks and loaders", "Concrete mixers and pumps"],
  },
  {
    id: 6,
    name: "Logistics & Freight Services",
    nameDari: "خدمات لوژستیک و باربری",
    namePashto: "لوجستیکي او بار وړلو خدمات",
    category: "Logistics",
    categoryDari: "لوژستیک",
    icon: Container,
    description: "End-to-end logistics solutions including warehousing, transportation, and customs clearance across Afghanistan.",
    descriptionDari: "راه حل های لوژستیک end-to-end شامل انبارداری، حمل و نقل و ترخیص گمرکی در سراسر افغانستان.",
    specs: ["Nationwide fleet network", "Cold chain logistics", "Real-time tracking"],
  },
];

export default function ProductsSection() {
  const { lang } = useI18n();

  return (
    <section className="py-24 bg-[#0A1628] relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_#C9A227/5_0%,_transparent_50%)]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16">
          <div>
            <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
              <Package className="w-4 h-4 inline mr-2" />
              {lang === "en" ? "Products & Services" : lang === "dari" ? "محصولات و خدمات" : "محصولات او خدمات"}
            </span>
            <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
              {lang === "en" ? (
                <>
                  Featured <span className="text-[#C9A227]">Products</span>
                </>
              ) : lang === "dari" ? (
                <>
                  محصولات <span className="text-[#C9A227]">برجسته</span>
                </>
              ) : (
                <>
                  ټاکل شوي <span className="text-[#C9A227]">محصولات</span>
                </>
              )}
            </h2>
            <p className="text-white/50 max-w-xl">
              {lang === "en"
                ? "High-quality construction materials, energy solutions, and logistics services from our own production facilities."
                : lang === "dari"
                  ? "مواد ساختمانی با کیفیت بالا، راه حل های انرژی و خدمات لوژستیک از تاسیسات تولیدی خود ما."
                  : "د لوړ کیفیت جوړونې مواد، د انرژي حلونه، او د لوجستیکي خدماتو زموږ د خپلو تولیدي تاسیساتو څخه."}
            </p>
          </div>
          <Link
            href="/products"
            className="mt-4 lg:mt-0 inline-flex items-center gap-2 text-[#C9A227] font-semibold hover:gap-3 transition-all"
          >
            {lang === "en" ? "View All Products" : lang === "dari" ? "مشاهده همه محصولات" : "ټول محصولات وګورئ"}
            <ArrowRight className="w-5 h-5" />
          </Link>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {featuredProducts.map((product) => {
            const Icon = product.icon;
            return (
              <div
                key={product.id}
                className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-[#C9A227]/20 transition-all duration-500"
              >
                <div className="aspect-[16/10] relative overflow-hidden bg-[#0A1628]">
                  <div className="absolute inset-0 bg-[#C9A227]/5 flex items-center justify-center">
                    <Icon className="w-16 h-16 text-[#C9A227]/20" />
                  </div>
                  <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors" />
                  <div className="absolute top-4 left-4">
                    <span className="px-3 py-1 rounded-full bg-[#0A1628]/80 text-[#C9A227] text-xs font-medium border border-[#C9A227]/20">
                      {lang === "en" ? product.category : product.categoryDari}
                    </span>
                  </div>
                </div>
                <div className="p-6">
                  <h3 className="text-white font-bold text-xl mb-2 group-hover:text-[#C9A227] transition-colors">
                    {lang === "en" ? product.name : lang === "dari" ? product.nameDari : product.namePashto}
                  </h3>
                  <p className="text-white/50 text-sm leading-relaxed mb-4">
                    {lang === "en" ? product.description : product.descriptionDari}
                  </p>
                  <ul className="space-y-2">
                    {product.specs.map((spec, i) => (
                      <li key={i} className="flex items-center gap-2 text-white/40 text-xs">
                        <CheckCircle2 className="w-3.5 h-3.5 text-[#C9A227]/60" />
                        {spec}
                      </li>
                    ))}
                  </ul>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}