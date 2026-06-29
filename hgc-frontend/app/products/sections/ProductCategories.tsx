"use client";

import React, { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import {
  Factory,
  Gem,
  Fuel,
  HardHat,
  Boxes,
  ChevronRight,
  ArrowRight,
  Check,
  Droplets,
  Flame,
  Truck,
  Mountain,
  Diamond,
  Pickaxe,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import ScrollReveal from "@/components/ScrollReveal";

interface ProductItem {
  id: string;
  name: string;
  description: string;
  image: string;
  specs: string[];
  icon: React.ElementType;
}

interface Category {
  id: string;
  slug: string;
  title: string;
  description: string;
  icon: React.ElementType;
  accentColor: string;
  image: string;
  products: ProductItem[];
}

const categories: Category[] = [
  {
    id: "cat-0",
    slug: "minerals-metals",
    title: "Minerals & Metals",
    description:
      "We explore, extract, and process metals & mineral resources through responsible mining practices, supporting long-term supply and sustainable growth.",
    icon: Pickaxe,
    accentColor: "#B22222",
    image: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&q=80",
    products: [
      {
        id: "p1",
        name: "Copper Ore",
        description: "High-grade copper ore extracted from Logar and Balkh provinces, suitable for smelting and industrial applications.",
        image: "https://images.unsplash.com/photo-1618331835717-801e976710b2?w=600&q=80",
        specs: ["Grade: 25-35% Cu", "Origin: Logar Province", "MOQ: 500 MT"],
        icon: Mountain,
      },
      {
        id: "p2",
        name: "Iron Ore",
        description: "Premium iron ore with consistent Fe content, ideal for steel production and metallurgical processes.",
        image: "https://images.unsplash.com/photo-1560251180-1a0b9a9a9a9a?w=600&q=80",
        specs: ["Grade: 62-65% Fe", "Origin: Hajigak", "MOQ: 1,000 MT"],
        icon: Mountain,
      },
      {
        id: "p3",
        name: "Chromite",
        description: "High-chromium chromite ore for stainless steel, refractory materials, and chemical industries.",
        image: "https://images.unsplash.com/photo-1595113316349-9fa4eb24f884?w=600&q=80",
        specs: ["Grade: 42-48% Cr₂O₃", "Origin: Khost", "MOQ: 300 MT"],
        icon: Mountain,
      },
      {
        id: "p4",
        name: "Lead & Zinc",
        description: "Refined lead and zinc concentrates for battery manufacturing, galvanizing, and alloy production.",
        image: "https://images.unsplash.com/photo-1535068484622-7a079e573d4f?w=600&q=80",
        specs: ["Pb: 55-65%", "Zn: 50-58%", "Origin: Ghor"],
        icon: Mountain,
      },
    ],
  },
  {
    id: "cat-1",
    slug: "stones-gemstones",
    title: "Stones & Gemstones",
    description:
      "From the heart of Afghanistan's mountains, we bring you natural stones and rare gemstones that reflect beauty, quality, and authenticity.",
    icon: Gem,
    accentColor: "#1A237E",
    image: "https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=1200&q=80",
    products: [
      {
        id: "p5",
        name: "Lapis Lazuli",
        description: "World-renowned deep blue lapis lazuli from Badakhshan mines, prized for jewelry and decorative arts.",
        image: "https://images.unsplash.com/photo-1612817288484-6f916006741a?w=600&q=80",
        specs: ["Grade: AAA", "Origin: Badakhshan", "Cut: Cabochon / Rough"],
        icon: Diamond,
      },
      {
        id: "p6",
        name: "Emerald",
        description: "Vivid green emeralds from the Panjshir Valley, among the finest in the world for fine jewelry.",
        image: "https://images.unsplash.com/photo-1601121141461-9d6647bca1ed?w=600&q=80",
        specs: ["Grade: A-AA", "Origin: Panjshir", "Cut: Oval / Emerald"],
        icon: Diamond,
      },
      {
        id: "p7",
        name: "Afghan Marble",
        description: "Premium white and colored marble blocks and slabs for construction, flooring, and sculpture.",
        image: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&q=80",
        specs: ["Types: White / Onyx / Travertine", "Origin: Herat / Helmand", "Finish: Polished / Honed"],
        icon: Mountain,
      },
      {
        id: "p8",
        name: "Granite",
        description: "Durable granite in various colors for countertops, monuments, and high-traffic flooring.",
        image: "https://images.unsplash.com/photo-1567225557594-88d73e55f2cb?w=600&q=80",
        specs: ["Colors: Black / Red / Grey", "Origin: Kabul", "Finish: Flamed / Polished"],
        icon: Mountain,
      },
    ],
  },
  {
    id: "cat-2",
    slug: "refinery-products",
    title: "Refinery Products",
    description:
      "From our refining operations, we supply essential petroleum products — including diesel, petrol, LPG, and bitumen — meeting market requirements for reliability, efficiency, and consistent quality.",
    icon: Fuel,
    accentColor: "#F57C00",
    image: "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=1200&q=80",
    products: [
      {
        id: "p9",
        name: "Petrol (Gasoline)",
        description: "High-octane petrol meeting international standards for automotive and industrial engines.",
        image: "https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=600&q=80",
        specs: ["Octane: 95 / 98", "Grade: Euro 5", "Packaging: Bulk / Drum"],
        icon: Flame,
      },
      {
        id: "p10",
        name: "Diesel",
        description: "Ultra-low sulfur diesel for transportation, power generation, and heavy machinery.",
        image: "https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?w=600&q=80",
        specs: ["Sulfur: <10 ppm", "Grade: Euro 5", "Packaging: Bulk / Tanker"],
        icon: Truck,
      },
      {
        id: "p11",
        name: "LPG (Liquefied Petroleum Gas)",
        description: "Clean-burning LPG for residential, commercial, and industrial heating and cooking.",
        image: "https://images.unsplash.com/photo-1611273426761-53c8577a3c97?w=600&q=80",
        specs: ["Purity: 99.5%", "Packaging: Cylinder / Bulk", "Applications: Heating / Cooking"],
        icon: Flame,
      },
      {
        id: "p12",
        name: "Bitumen",
        description: "High-quality bitumen for road construction, waterproofing, and industrial applications.",
        image: "https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=600&q=80",
        specs: ["Grades: 60/70 / 80/100", "Origin: Domestic Refinery", "Packaging: Drum / Bulk"],
        icon: Droplets,
      },
    ],
  },
  {
    id: "cat-3",
    slug: "construction-materials",
    title: "Construction Materials",
    description:
      "Essential building materials sourced and supplied to support Afghanistan's growing infrastructure and development projects.",
    icon: HardHat,
    accentColor: "#2E7D32",
    image: "https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1200&q=80",
    products: [
      {
        id: "p13",
        name: "Portland Cement",
        description: "High-strength Portland cement for residential, commercial, and infrastructure construction.",
        image: "https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=600&q=80",
        specs: ["Type: OPC 42.5 / 52.5", "Standard: ASTM C150", "Packaging: 50kg Bag / Bulk"],
        icon: Boxes,
      },
      {
        id: "p14",
        name: "Steel Rebar",
        description: "Deformed steel reinforcement bars for concrete structures, bridges, and buildings.",
        image: "https://images.unsplash.com/photo-1565514020176-db9e1b5a0c58?w=600&q=80",
        specs: ["Grades: Grade 40 / 60", "Sizes: 8mm - 32mm", "Standard: ASTM A615"],
        icon: HardHat,
      },
      {
        id: "p15",
        name: "Ready-Mix Concrete",
        description: "Custom-mixed concrete delivered to site for foundations, slabs, and structural elements.",
        image: "https://images.unsplash.com/photo-1590644365607-1c5a519e7b37?w=600&q=80",
        specs: ["Strength: C20 - C50", "Delivery: On-site", "Additives: Available"],
        icon: Truck,
      },
      {
        id: "p16",
        name: "Structural Steel",
        description: "Beams, columns, and structural steel sections for industrial and commercial buildings.",
        image: "https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80",
        specs: ["Profiles: I-Beam / H-Beam / Angle", "Steel: S235 / S355", "Finish: Galvanized / Painted"],
        icon: HardHat,
      },
    ],
  },
  {
    id: "cat-4",
    slug: "industrial-chemicals",
    title: "Industrial Chemicals",
    description:
      "Chemical products and fertilizers supporting agriculture, manufacturing, and industrial processes across Afghanistan.",
    icon: Boxes,
    accentColor: "#00838F",
    image: "https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=1200&q=80",
    products: [
      {
        id: "p17",
        name: "Urea Fertilizer",
        description: "High-nitrogen urea fertilizer for boosting crop yields in Afghan agriculture.",
        image: "https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=600&q=80",
        specs: ["Nitrogen: 46%", "Form: Prilled / Granular", "Packaging: 50kg Bag"],
        icon: Boxes,
      },
      {
        id: "p18",
        name: "NPK Fertilizer",
        description: "Balanced NPK compound fertilizers tailored for wheat, corn, and fruit cultivation.",
        image: "https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=600&q=80",
        specs: ["NPK: 15-15-15 / 20-20-20", "Form: Granular", "Packaging: 50kg Bag"],
        icon: Boxes,
      },
      {
        id: "p19",
        name: "Sulfuric Acid",
        description: "Industrial-grade sulfuric acid for mining, chemical processing, and battery production.",
        image: "https://images.unsplash.com/photo-1608037222011-cbf484177126?w=600&q=80",
        specs: ["Concentration: 98%", "Grade: Technical", "Packaging: IBC / Tanker"],
        icon: Droplets,
      },
      {
        id: "p20",
        name: "Caustic Soda",
        description: "Sodium hydroxide for water treatment, soap manufacturing, and textile processing.",
        image: "https://images.unsplash.com/photo-1608037521244-f1c6c7635194?w=600&q=80",
        specs: ["Form: Flakes / Pearls", "Purity: 99%", "Packaging: 25kg Bag"],
        icon: Boxes,
      },
    ],
  },
];

export default function ProductCategories() {
  const { lang, dir } = useI18n();
  const [activeCategory, setActiveCategory] = useState(0);
  const [hoveredProduct, setHoveredProduct] = useState<string | null>(null);
  const isRTL = dir === "rtl";

  const activeCat = categories[activeCategory];
  const CatIcon = activeCat.icon;

  return (
    <section id="categories" className="py-24 relative" dir={dir}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <ScrollReveal>
          <div className="text-center mb-16">
            <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.2em] mb-3 block">
              {t(lang, "products.categories.sectionSubtitle")}
            </span>
            <h2 className="text-3xl lg:text-5xl font-bold text-white mb-4">
              {t(lang, "products.categories.sectionTitle")}
            </h2>
            <p className="text-white/40 max-w-2xl mx-auto text-lg">
              {t(lang, "products.categories.sectionDesc")}
            </p>
          </div>
        </ScrollReveal>

        {/* Category Tabs */}
        <ScrollReveal delay={0.1}>
          <div className="flex items-center gap-2 overflow-x-auto pb-4 mb-12 scrollbar-hide">
            {categories.map((cat, idx) => {
              const Icon = cat.icon;
              const isActive = idx === activeCategory;
              return (
                <button
                  key={cat.id}
                  id={`category-${idx}`}
                  onClick={() => setActiveCategory(idx)}
                  className={`flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-medium whitespace-nowrap transition-all duration-300 ${
                    isActive
                      ? "text-white shadow-lg"
                      : "bg-white/5 text-white/50 hover:bg-white/10 hover:text-white border border-white/5"
                  }`}
                  style={
                    isActive
                      ? {
                          backgroundColor: `${cat.accentColor}20`,
                          border: `1px solid ${cat.accentColor}40`,
                          color: cat.accentColor,
                        }
                      : {}
                  }
                >
                  <Icon className="w-4 h-4" />
                  {cat.title}
                </button>
              );
            })}
          </div>
        </ScrollReveal>

        {/* Active Category Content */}
        <AnimatePresence mode="wait">
          <motion.div
            key={activeCat.id}
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            transition={{ duration: 0.4 }}
          >
            {/* Category Hero Banner */}
            <div className="relative rounded-3xl overflow-hidden mb-12">
              <div
                className="h-64 sm:h-80 bg-cover bg-center"
                style={{ backgroundImage: `url(${activeCat.image})` }}
              />
              <div className="absolute inset-0 bg-[#0A1628]/60" />
              <div className="absolute inset-0 flex items-center">
                <div className="max-w-3xl px-8 sm:px-12">
                  <div
                    className="w-14 h-14 rounded-2xl flex items-center justify-center mb-4"
                    style={{ backgroundColor: `${activeCat.accentColor}20` }}
                  >
                    <CatIcon className="w-7 h-7" style={{ color: activeCat.accentColor }} />
                  </div>
                  <h3 className="text-2xl sm:text-3xl font-bold text-white mb-3">
                    {activeCat.title}
                  </h3>
                  <p className="text-white/60 text-sm sm:text-base leading-relaxed max-w-xl">
                    {activeCat.description}
                  </p>
                </div>
              </div>
            </div>

            {/* Products Grid */}
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
              {activeCat.products.map((product, idx) => {
                const ProdIcon = product.icon;
                const isHovered = hoveredProduct === product.id;
                return (
                  <motion.div
                    key={product.id}
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.4, delay: idx * 0.1 }}
                    className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-white/10 transition-all duration-500"
                    onMouseEnter={() => setHoveredProduct(product.id)}
                    onMouseLeave={() => setHoveredProduct(null)}
                  >
                    {/* Product Image */}
                    <div className="relative h-48 overflow-hidden">
                      <div
                        className="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                        style={{ backgroundImage: `url(${product.image})` }}
                      />
                      <div className="absolute inset-0 bg-[#0A1628]/30 group-hover:bg-[#0A1628]/10 transition-colors duration-500" />

                      {/* Icon Badge */}
                      <div
                        className={`absolute top-3 ${isRTL ? "left-3" : "right-3"} w-9 h-9 rounded-lg flex items-center justify-center backdrop-blur-sm`}
                        style={{ backgroundColor: `${activeCat.accentColor}25` }}
                      >
                        <ProdIcon className="w-4 h-4" style={{ color: activeCat.accentColor }} />
                      </div>

                      {/* Hover Overlay */}
                      <div className="absolute inset-0 bg-[#0A1628]/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <button className="px-5 py-2.5 bg-[#C9A227] text-[#0A1628] font-semibold rounded-xl text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 flex items-center gap-2">
                          {t(lang, "products.categories.viewDetails")}
                          <ArrowRight className="w-4 h-4" />
                        </button>
                      </div>
                    </div>

                    {/* Content */}
                    <div className="p-5 space-y-3">
                      <h4 className="text-white font-semibold text-base group-hover:text-[#C9A227] transition-colors duration-300">
                        {product.name}
                      </h4>
                      <p className="text-white/40 text-sm leading-relaxed line-clamp-2">
                        {product.description}
                      </p>

                      {/* Specs */}
                      <div className="space-y-1.5 pt-2">
                        {product.specs.map((spec, sIdx) => (
                          <div key={sIdx} className="flex items-center gap-2 text-white/30 text-xs">
                            <Check className="w-3 h-3 text-[#C9A227]/60 flex-shrink-0" />
                            <span>{spec}</span>
                          </div>
                        ))}
                      </div>
                    </div>
                  </motion.div>
                );
              })}
            </div>

            {/* View All Link */}
            <div className="mt-10 text-center">
              <button className="inline-flex items-center gap-2 text-[#C9A227] font-medium hover:underline transition-all">
                {t(lang, "products.categories.viewAll")} {activeCat.title}
                <ChevronRight className="w-4 h-4" />
              </button>
            </div>
          </motion.div>
        </AnimatePresence>
      </div>
    </section>
  );
}
