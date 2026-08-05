"use client";

import { useState, useEffect, useCallback, useRef } from "react";
import Link from "next/link";
import Image from "next/image";
import {
  Newspaper,
  ArrowRight,
  ArrowLeft,
  Calendar,
  Tag,
  ChevronRight,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { motion, AnimatePresence, type Variants } from "framer-motion";

// ─── Static Dummy Data ─────────────────────────────────────────────
const DUMMY_NEWS = [
  {
    id: 1,
    slug: "hgc-completes-kabul-hospital",
    title: "HGC Completes State-of-the-Art Hospital in Kabul",
    excerpt:
      "Hafez Construction & Reconstruction Company has successfully delivered a 200-bed modern hospital facility featuring advanced medical infrastructure and sustainable energy systems.",
    category: "Project Completion",
    cover_image: "https://images.unsplash.com/photo-1587351021759-3e566b9af923?w=1200&q=80",
    published_at: "2026-07-28T10:00:00Z",
    author: "HGC Media Team",
  },
  {
    id: 2,
    slug: "new-mining-operations-herat",
    title: "New Mining Operations Launched in Herat Province",
    excerpt:
      "Al-Bahrain Mining Company has inaugurated its latest extraction facility in Herat, expected to create over 300 local jobs and significantly boost regional mineral output.",
    category: "Mining",
    cover_image: "https://images.unsplash.com/photo-1605218427306-022ba6c5544c?w=1200&q=80",
    published_at: "2026-07-20T08:30:00Z",
    author: "Engineering Desk",
  },
  {
    id: 3,
    slug: "solar-energy-initiative-2026",
    title: "HGC Announces Major Solar Energy Initiative for 2026",
    excerpt:
      "In partnership with international energy firms, Hafez Group is rolling out a nationwide solar electrification program targeting 50 remote villages across 12 provinces.",
    category: "Energy",
    cover_image: "https://images.unsplash.com/photo-1509391366360-2e959784a276?w=1200&q=80",
    published_at: "2026-07-15T14:00:00Z",
    author: "Energy Division",
  },

];

// ─── Helpers ───────────────────────────────────────────────────────
function formatDate(dateStr: string, lang: string): string {
  const date = new Date(dateStr);
  const options: Intl.DateTimeFormatOptions = {
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  if (lang === "en") return date.toLocaleDateString("en-US", options);
  if (lang === "dari") return date.toLocaleDateString("fa-AF", options);
  return date.toLocaleDateString("ps-AF", options);
}

// ─── Component ─────────────────────────────────────────────────────
export default function NewsSection() {
  const { lang } = useI18n();
  const [activeIndex, setActiveIndex] = useState(0);
  const [direction, setDirection] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const touchStartX = useRef(0);
  const containerRef = useRef<HTMLDivElement>(null);

  const news = DUMMY_NEWS;
  const total = news.length;

  const goTo = useCallback(
    (index: number) => {
      const newDir = index > activeIndex ? 1 : -1;
      setDirection(newDir);
      setActiveIndex((index + total) % total);
    },
    [activeIndex, total]
  );

  const next = useCallback(() => goTo(activeIndex + 1), [activeIndex, goTo]);
  const prev = useCallback(() => goTo(activeIndex - 1), [activeIndex, goTo]);

  // Auto-play
  useEffect(() => {
    if (isPaused) return;
    const timer = setInterval(next, 6000);
    return () => clearInterval(timer);
  }, [isPaused, next]);

  // Keyboard navigation
  useEffect(() => {
    const handleKey = (e: KeyboardEvent) => {
      if (e.key === "ArrowRight") next();
      if (e.key === "ArrowLeft") prev();
    };
    window.addEventListener("keydown", handleKey);
    return () => window.removeEventListener("keydown", handleKey);
  }, [next, prev]);

  // Touch / swipe
  const onTouchStart = (e: React.TouchEvent) => {
    touchStartX.current = e.touches[0].clientX;
  };
  const onTouchEnd = (e: React.TouchEvent) => {
    const diff = touchStartX.current - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) {
      diff > 0 ? next() : prev();
    }
  };

  // Clamp activeIndex if it exceeds bounds (e.g. after removing items)
  useEffect(() => {
    if (activeIndex >= total) {
      setActiveIndex(0);
      setDirection(1);
    }
  }, [total, activeIndex]);

  const current = news[activeIndex] || news[0];

  // ─── Don't render if no news ───────────────────────────────────
  if (news.length === 0) return null;

  const sectionLabel =
    lang === "en" ? "Latest Updates" : lang === "dari" ? "آخرین اخبار" : "وروستي خبرونه";

  const sectionTitle =
    lang === "en" ? (
      <>
        News & <span className="text-hgc-gold">Insights</span>
      </>
    ) : lang === "dari" ? (
      <>
        <span className="text-hgc-gold">اخبار</span> و بینش‌ها
      </>
    ) : (
      <>
        <span className="text-hgc-gold">خبرونه</span> او بینچونه
      </>
    );

  const viewAllLabel =
    lang === "en"
      ? "View All News"
      : lang === "dari"
        ? "مشاهده همه اخبار"
        : "ټول خبرونه وګورئ";

  const readMoreLabel =
    lang === "en" ? "Read Full Story" : lang === "dari" ? "بیشتر بخوانید" : "نور ولولئ";

  // Slide animation variants
  const slideVariants = {
    enter: (dir: number) => ({
      x: dir > 0 ? "100%" : "-100%",
      opacity: 0,
      scale: 0.95,
    }),
    center: {
      x: 0,
      opacity: 1,
      scale: 1,
      transition: { duration: 0.7, ease: [0.22, 1, 0.36, 1] as const },
    },
    exit: (dir: number) => ({
      x: dir > 0 ? "-100%" : "100%",
      opacity: 0,
      scale: 0.95,
      transition: { duration: 0.7, ease: [0.22, 1, 0.36, 1] as const },
    }),
  };

  const textVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: (i: number) => ({
      opacity: 1,
      y: 0,
      transition: { delay: 0.2 + i * 0.1, duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
    }),
  };

  return (
    <section
      className="py-24 bg-hgc-bg relative overflow-hidden"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      {/* Background glow */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[600px] bg-hgc-gold/[0.03] rounded-full blur-[150px]" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* ─── Section Header ────────────────────────────────────── */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-12"
        >
          <div>
            <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-hgc-gold/10 border border-hgc-gold/20 text-hgc-gold text-sm font-medium mb-5">
              <Newspaper className="w-4 h-4" />
              {sectionLabel}
            </span>
            <h2 className="text-4xl lg:text-5xl font-bold text-hgc-text tracking-tight">
              {sectionTitle}
            </h2>
          </div>
          <Link
            href="/news"
            className="group mt-6 lg:mt-0 inline-flex items-center gap-2 text-hgc-gold font-semibold hover:gap-3 transition-all"
          >
            {viewAllLabel}
            <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
          </Link>
        </motion.div>

        {/* ─── Main Carousel ─────────────────────────────────────── */}
        <div
          ref={containerRef}
          className="relative"
          onTouchStart={onTouchStart}
          onTouchEnd={onTouchEnd}
        >
          {/* Featured Slide */}
          <div className="relative aspect-[21/9] lg:aspect-[21/8] rounded-3xl overflow-hidden bg-hgc-card-alt">
            <AnimatePresence initial={false} custom={direction} mode="popLayout">
              <motion.div
                key={activeIndex}
                custom={direction}
                variants={slideVariants}
                initial="enter"
                animate="center"
                exit="exit"
                className="absolute inset-0"
              >
                {/* Image */}
                <Image
                  src={current.cover_image}
                  alt={current.title}
                  fill
                  className="object-cover"
                  priority
                  sizes="100vw"
                />

                {/* Cinematic gradient overlays */}
                <div className="absolute inset-0 bg-gradient-to-r from-hgc-overlay/80 via-hgc-overlay/40 to-transparent" />
                <div className="absolute inset-0 bg-gradient-to-t from-hgc-overlay/70 via-transparent to-hgc-overlay/20" />

                {/* Content */}
                <div className="absolute inset-0 flex flex-col justify-end p-8 lg:p-14">
                  <div className="max-w-2xl">
                    {/* Category + Date row */}
                    <motion.div
                      custom={0}
                      variants={textVariants}
                      initial="hidden"
                      animate="visible"
                      className="flex items-center gap-4 mb-4"
                    >
                      <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-hgc-gold/20 backdrop-blur-md text-hgc-gold text-xs font-bold border border-hgc-gold/30">
                        <Tag className="w-3 h-3" />
                        {current.category}
                      </span>
                      <span className="inline-flex items-center gap-1.5 text-hgc-surface/70 text-sm">
                        <Calendar className="w-3.5 h-3.5" />
                        {formatDate(current.published_at, lang)}
                      </span>

                    </motion.div>

                    {/* Title */}
                    <motion.h3
                      custom={1}
                      variants={textVariants}
                      initial="hidden"
                      animate="visible"
                      className="text-hgc-surface font-bold text-2xl lg:text-4xl mb-4 leading-tight"
                    >
                      {current.title}
                    </motion.h3>

                    {/* Excerpt */}
                    <motion.p
                      custom={2}
                      variants={textVariants}
                      initial="hidden"
                      animate="visible"
                      className="text-hgc-surface/70 text-sm lg:text-base leading-relaxed mb-6 line-clamp-2 max-w-xl"
                    >
                      {current.excerpt}
                    </motion.p>

                    {/* CTA */}
                    <motion.div
                      custom={3}
                      variants={textVariants}
                      initial="hidden"
                      animate="visible"
                    >
                      <Link
                        href={`/news/${current.slug}`}
                        className="group inline-flex items-center gap-3 px-6 py-3 bg-hgc-gold text-hgc-text font-bold rounded-xl hover:bg-hgc-gold-bright transition-all duration-300 hover:shadow-lg hover:shadow-hgc-gold/30 hover:-translate-y-0.5"
                      >
                        {readMoreLabel}
                        <ChevronRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                      </Link>
                    </motion.div>
                  </div>
                </div>
              </motion.div>
            </AnimatePresence>

            {/* Navigation Arrows */}
            <button
              onClick={prev}
              className="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-hgc-surface/10 backdrop-blur-md border border-hgc-surface/20 flex items-center justify-center text-hgc-surface hover:bg-hgc-gold hover:border-hgc-gold hover:text-hgc-text transition-all duration-300 z-10"
              aria-label="Previous"
            >
              <ArrowLeft className="w-5 h-5" />
            </button>
            <button
              onClick={next}
              className="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-hgc-surface/10 backdrop-blur-md border border-hgc-surface/20 flex items-center justify-center text-hgc-surface hover:bg-hgc-gold hover:border-hgc-gold hover:text-hgc-text transition-all duration-300 z-10"
              aria-label="Next"
            >
              <ArrowRight className="w-5 h-5" />
            </button>

            {/* Progress bar */}
            <div className="absolute bottom-0 left-0 right-0 h-1 bg-hgc-surface/10">
              <motion.div
                className="h-full bg-hgc-gold"
                initial={{ width: "0%" }}
                animate={{ width: "100%" }}
                transition={{ duration: 6, ease: "linear" }}
                key={activeIndex}
              />
            </div>
          </div>

          {/* ─── Thumbnail Strip ─────────────────────────────────── */}
          <div className="mt-6 flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
            {news.map((item, idx) => {
              const isActive = idx === activeIndex;
              return (
                <button
                  key={item.id}
                  onClick={() => goTo(idx)}
                  className={`group flex-shrink-0 flex items-center gap-3 px-4 py-3 rounded-xl border transition-all duration-300 ${isActive
                      ? "bg-hgc-gold/10 border-hgc-gold/40 w-64"
                      : "bg-hgc-card border-hgc-border hover:border-hgc-gold/20 w-56"
                    }`}
                >
                  <div className="relative w-14 h-14 rounded-lg overflow-hidden flex-shrink-0">
                    <Image
                      src={item.cover_image}
                      alt={item.title}
                      fill
                      className="object-cover"
                      sizes="56px"
                    />
                    {isActive && (
                      <div className="absolute inset-0 bg-hgc-gold/20" />
                    )}
                  </div>
                  <div className="text-left min-w-0">
                    <p
                      className={`text-sm font-semibold truncate transition-colors ${isActive ? "text-hgc-gold" : "text-hgc-text group-hover:text-hgc-gold"
                        }`}
                    >
                      {item.title}
                    </p>
                    <p className="text-hgc-text-muted text-xs mt-0.5">
                      {formatDate(item.published_at, lang)}
                    </p>
                  </div>
                </button>
              );
            })}
          </div>

          {/* Dot indicators */}
          <div className="flex items-center justify-center gap-2 mt-4">
            {news.map((_, idx) => (
              <button
                key={idx}
                onClick={() => goTo(idx)}
                className={`transition-all duration-300 rounded-full ${idx === activeIndex
                    ? "w-8 h-2 bg-hgc-gold"
                    : "w-2 h-2 bg-hgc-border hover:bg-hgc-gold/50"
                  }`}
                aria-label={`Go to slide ${idx + 1}`}
              />
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}