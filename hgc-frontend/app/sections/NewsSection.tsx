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
  Loader2,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { motion, AnimatePresence } from "framer-motion";

interface NewsArticle {
  id: number;
  slug: string;
  title: string;
  excerpt: string;
  category: string;
  cover_image: string | null;
  published_at: string;
}

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

export default function NewsSection() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const [news, setNews] = useState<NewsArticle[]>([]);
  const [loading, setLoading] = useState(true);
  const [activeIndex, setActiveIndex] = useState(0);
  const [direction, setDirection] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const touchStartX = useRef(0);
  const containerRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const fetchNews = async () => {
      try {
        setLoading(true);
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/news?lang=${lang}`;
        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
        });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();
        if (json.success) {
          setNews(json.data);
          setActiveIndex(0);
        }
      } catch (err) {
        console.error("News fetch error:", err);
        setNews([]);
      } finally {
        setLoading(false);
      }
    };
    fetchNews();
  }, [lang]);

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

  useEffect(() => {
    if (isPaused || total === 0) return;
    const timer = setInterval(next, 6000);
    return () => clearInterval(timer);
  }, [isPaused, next, total]);

  useEffect(() => {
    const handleKey = (e: KeyboardEvent) => {
      if (e.key === "ArrowRight") isRtl ? prev() : next();
      if (e.key === "ArrowLeft") isRtl ? next() : prev();
    };
    window.addEventListener("keydown", handleKey);
    return () => window.removeEventListener("keydown", handleKey);
  }, [next, prev, isRtl]);

  const onTouchStart = (e: React.TouchEvent) => {
    touchStartX.current = e.touches[0].clientX;
  };
  const onTouchEnd = (e: React.TouchEvent) => {
    const diff = touchStartX.current - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) {
      isRtl ? (diff < 0 ? next() : prev()) : (diff > 0 ? next() : prev());
    }
  };

  useEffect(() => {
    if (activeIndex >= total && total > 0) {
      setActiveIndex(0);
      setDirection(1);
    }
  }, [total, activeIndex]);

  if (loading) {
    return (
      <section className="py-24 bg-hgc-bg relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center min-h-[400px]">
          <Loader2 className="w-10 h-10 text-hgc-gold animate-spin" />
        </div>
      </section>
    );
  }

  if (news.length === 0) {
    return (
      <section className="py-24 bg-hgc-bg relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center min-h-[400px]">
          <p className="text-hgc-text-muted text-sm">No news available.</p>
        </div>
      </section>
    );
  }

  const current = news[activeIndex] || news[0];

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

  const readMoreLabel =
    lang === "en" ? "Read Full Story" : lang === "dari" ? "بیشتر بخوانید" : "نور ولولئ";

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
      dir={isRtl ? "rtl" : "ltr"}
      className="py-24 bg-hgc-bg relative overflow-hidden"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[600px] bg-hgc-gold/[0.03] rounded-full blur-[150px]" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Header */}
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
        </motion.div>

        {/* Main Carousel */}
        <div
          ref={containerRef}
          className="relative"
          onTouchStart={onTouchStart}
          onTouchEnd={onTouchEnd}
        >
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
                {current.cover_image ? (
                  <Image
                    src={current.cover_image}
                    alt={current.title}
                    fill
                    className="object-cover"
                    priority
                    sizes="100vw"
                  />
                ) : (
                  <div className="absolute inset-0 bg-gradient-to-br from-[#0F2B5B] to-[#1a1a2e]" />
                )}

                <div
                  className={`absolute inset-0 ${
                    isRtl ? "bg-gradient-to-l" : "bg-gradient-to-r"
                  } from-hgc-overlay/80 via-hgc-overlay/40 to-transparent`}
                />
                <div className="absolute inset-0 bg-gradient-to-t from-hgc-overlay/70 via-transparent to-hgc-overlay/20" />

                <div className="absolute inset-0 flex flex-col justify-end p-8 lg:p-14">
                  <div className="max-w-2xl">
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

                    <motion.h3
                      custom={1}
                      variants={textVariants}
                      initial="hidden"
                      animate="visible"
                      className="text-hgc-surface font-bold text-2xl lg:text-4xl mb-4 leading-tight"
                    >
                      {current.title}
                    </motion.h3>

                    <motion.p
                      custom={2}
                      variants={textVariants}
                      initial="hidden"
                      animate="visible"
                      className="text-hgc-surface/70 text-sm lg:text-base leading-relaxed mb-6 line-clamp-2 max-w-xl"
                    >
                      {current.excerpt}
                    </motion.p>

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
                        <ChevronRight className={`w-4 h-4 transition-transform ${isRtl ? "rotate-180 group-hover:-translate-x-1" : "group-hover:translate-x-1"}`} />
                      </Link>
                    </motion.div>
                  </div>
                </div>
              </motion.div>
            </AnimatePresence>

            {/* Navigation Arrows */}
            <button
              onClick={prev}
              className={`absolute top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-hgc-surface/10 backdrop-blur-md border border-hgc-surface/20 flex items-center justify-center text-hgc-surface hover:bg-hgc-gold hover:border-hgc-gold hover:text-hgc-text transition-all duration-300 z-10 ${
                isRtl ? "right-4" : "left-4"
              }`}
              aria-label="Previous"
            >
              <ArrowLeft className="w-5 h-5" />
            </button>
            <button
              onClick={next}
              className={`absolute top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-hgc-surface/10 backdrop-blur-md border border-hgc-surface/20 flex items-center justify-center text-hgc-surface hover:bg-hgc-gold hover:border-hgc-gold hover:text-hgc-text transition-all duration-300 z-10 ${
                isRtl ? "left-4" : "right-4"
              }`}
              aria-label="Next"
            >
              <ArrowRight className="w-5 h-5" />
            </button>

            {/* Progress bar */}
            <div className="absolute bottom-0 left-0 right-0 h-1 bg-hgc-surface/10">
              <motion.div
                className="h-full bg-hgc-gold"
                initial={isRtl ? { width: "100%", x: "0%" } : { width: "0%" }}
                animate={isRtl ? { width: "100%", x: "0%" } : { width: "100%" }}
                style={isRtl ? { transformOrigin: "right" } : { transformOrigin: "left" }}
                transition={{ duration: 6, ease: "linear" }}
                key={activeIndex}
              />
            </div>
          </div>

          {/* Thumbnail Strip */}
          <div className="mt-6 flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
            {news.map((item, idx) => {
              const isActive = idx === activeIndex;
              return (
                <button
                  key={item.id}
                  onClick={() => goTo(idx)}
                  className={`group flex-shrink-0 flex items-center gap-3 px-4 py-3 rounded-xl border transition-all duration-300 ${
                    isActive
                      ? "bg-hgc-gold/10 border-hgc-gold/40 w-64"
                      : "bg-hgc-card border-hgc-border hover:border-hgc-gold/20 w-56"
                  }`}
                >
                  <div className="relative w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-gradient-to-br from-[#0F2B5B] to-[#1a1a2e]">
                    {item.cover_image ? (
                      <Image
                        src={item.cover_image}
                        alt={item.title}
                        fill
                        className="object-cover"
                        sizes="56px"
                      />
                    ) : null}
                    {isActive && (
                      <div className="absolute inset-0 bg-hgc-gold/20" />
                    )}
                  </div>
                  <div className="min-w-0 text-start">
                    <p
                      className={`text-sm font-semibold truncate transition-colors ${
                        isActive ? "text-hgc-gold" : "text-hgc-text group-hover:text-hgc-gold"
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
                className={`transition-all duration-300 rounded-full ${
                  idx === activeIndex
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