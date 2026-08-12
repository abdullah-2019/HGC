"use client";

import { useState, useEffect, useCallback } from "react";
import Link from "next/link";
import Image from "next/image";
import {
  CalendarDays,
  ArrowRight,
  ArrowLeft,
  MapPin,
  Clock,
  Ticket,
  Loader2,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { motion, AnimatePresence } from "framer-motion";

interface EventItem {
  id: number;
  slug: string;
  title: string;
  description: string;
  location: string | null;
  event_date: string;
  event_time: string | null;
  cover_image: string | null;
  is_upcoming: boolean;
}

function formatEventDate(
  dateStr: string,
  lang: string
): { day: string; month: string; year: string; weekday: string } {
  const date = new Date(dateStr);
  const day = date.getDate().toString().padStart(2, "0");
  const year = date.getFullYear().toString();

  let month = "";
  let weekday = "";
  if (lang === "en") {
    month = date.toLocaleDateString("en-US", { month: "short" });
    weekday = date.toLocaleDateString("en-US", { weekday: "long" });
  } else if (lang === "dari") {
    month = date.toLocaleDateString("fa-AF", { month: "short" });
    weekday = date.toLocaleDateString("fa-AF", { weekday: "long" });
  } else {
    month = date.toLocaleDateString("ps-AF", { month: "short" });
    weekday = date.toLocaleDateString("ps-AF", { weekday: "long" });
  }

  return { day, month, year, weekday };
}

export default function EventsSection() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const [events, setEvents] = useState<EventItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [activeIndex, setActiveIndex] = useState(0);
  const [direction, setDirection] = useState(0);
  const [isPaused, setIsPaused] = useState(false);

  useEffect(() => {
    const fetchEvents = async () => {
      try {
        setLoading(true);
        const res = await fetch(
          `${process.env.NEXT_PUBLIC_API_URL}/api/events?lang=${lang}`,
          { headers: { Accept: "application/json" } }
        );
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();
        if (json.success) {
          setEvents(json.data);
          setActiveIndex(0);
        }
      } catch (err) {
        console.error("Events fetch error:", err);
        setEvents([]);
      } finally {
        setLoading(false);
      }
    };
    fetchEvents();
  }, [lang]);

  const total = events.length;

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
    const timer = setInterval(next, 7000);
    return () => clearInterval(timer);
  }, [isPaused, next, total]);

  useEffect(() => {
    if (activeIndex >= total && total > 0) {
      setActiveIndex(0);
      setDirection(1);
    }
  }, [total, activeIndex]);

  if (loading) {
    return (
      <section className="py-24 bg-hgc-bg-alt relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center min-h-[400px]">
          <Loader2 className="w-10 h-10 text-hgc-gold animate-spin" />
        </div>
      </section>
    );
  }

  if (events.length === 0) {
    return null;
  }

  const current = events[activeIndex] || events[0];
  const dateParts = formatEventDate(current.event_date, lang);

  const sectionLabel =
    lang === "en"
      ? "Upcoming Events"
      : lang === "dari"
        ? "رویدادهای پیش رو"
        : "راتلونکې پیښې";

  const sectionTitle =
    lang === "en" ? (
      <>
        Events & <span className="text-hgc-gold">Conferences</span>
      </>
    ) : lang === "dari" ? (
      <>
        <span className="text-hgc-gold">رویدادها</span> و کنفرانس‌ها
      </>
    ) : (
      <>
        <span className="text-hgc-gold">پیښې</span> او کنفرانسونه
      </>
    );

  const viewAllLabel =
    lang === "en"
      ? "View All Events"
      : lang === "dari"
        ? "مشاهده همه رویدادها"
        : "ټولې پیښې وګورئ";

  const learnMoreLabel =
    lang === "en"
      ? "Learn More"
      : lang === "dari"
        ? "بیشتر بدانید"
        : "نور معلومات";

  const upcomingLabel =
    lang === "en" ? "Upcoming" : lang === "dari" ? "پیش رو" : "راتلونکی";

  const imageVariants = {
    enter: (dir: number) => ({
      x: dir > 0 ? 80 : -80,
      opacity: 0,
      scale: 1.05,
    }),
    center: {
      x: 0,
      opacity: 1,
      scale: 1,
      transition: { duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
    },
    exit: (dir: number) => ({
      x: dir > 0 ? -80 : 80,
      opacity: 0,
      scale: 0.98,
      transition: { duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
    }),
  };

  return (
    <section
      dir={isRtl ? "rtl" : "ltr"}
      className="py-24 bg-hgc-bg-alt relative overflow-hidden"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      <div className="absolute top-0 right-0 w-[600px] h-[600px] bg-hgc-gold/[0.02] rounded-full blur-[150px] translate-x-1/3 -translate-y-1/3" />
      <div className="absolute bottom-0 left-0 w-[500px] h-[500px] bg-hgc-navy/[0.02] rounded-full blur-[120px] -translate-x-1/4 translate-y-1/4" />

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
              <CalendarDays className="w-4 h-4" />
              {sectionLabel}
            </span>
            <h2 className="text-4xl lg:text-5xl font-bold text-hgc-text tracking-tight">
              {sectionTitle}
            </h2>
          </div>
          <Link
            href="/events"
            className="group mt-6 lg:mt-0 inline-flex items-center gap-2 text-hgc-gold font-semibold hover:gap-3 transition-all"
          >
            {viewAllLabel}
            <ArrowRight className={`w-5 h-5 transition-transform ${isRtl ? "rotate-180 group-hover:-translate-x-1" : "group-hover:translate-x-1"}`} />
          </Link>
        </motion.div>

        {/* Split Layout */}
        <div className="grid lg:grid-cols-12 gap-8">
          {/* Featured Event */}
          <div className="lg:col-span-7 order-1 lg:order-1 rtl:lg:order-2 relative">
            <div className="relative aspect-[4/3] lg:aspect-[16/10] rounded-3xl overflow-hidden bg-hgc-card-alt">
              <AnimatePresence initial={false} custom={direction} mode="popLayout">
                <motion.div
                  key={activeIndex}
                  custom={direction}
                  variants={imageVariants}
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
                      sizes="(max-width: 1024px) 100vw, 60vw"
                    />
                  ) : (
                    <div className="absolute inset-0 bg-gradient-to-br from-[#0F2B5B] to-[#1a1a2e]" />
                  )}
                  <div className="absolute inset-0 bg-gradient-to-t from-hgc-overlay/90 via-hgc-overlay/30 to-transparent" />
                  <div
                    className={`absolute inset-0 ${
                      isRtl ? "bg-gradient-to-l" : "bg-gradient-to-r"
                    } from-hgc-overlay/60 to-transparent`}
                  />
                </motion.div>
              </AnimatePresence>

              {/* Date badge */}
              <div className={`absolute top-6 z-10 ${isRtl ? "right-6" : "left-6"}`}>
                <div className="bg-hgc-surface/95 backdrop-blur-md rounded-2xl p-4 text-center shadow-xl border border-hgc-border">
                  <span className="block text-hgc-gold text-xs font-bold uppercase tracking-wider">
                    {dateParts.month}
                  </span>
                  <span className="block text-hgc-text text-3xl font-black leading-none mt-1">
                    {dateParts.day}
                  </span>
                  <span className="block text-hgc-text-muted text-xs mt-1">
                    {dateParts.weekday}
                  </span>
                </div>
              </div>

              {/* Upcoming badge */}
              {current.is_upcoming && (
                <div className={`absolute top-6 z-10 ${isRtl ? "left-6" : "right-6"}`}>
                  <span className="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-hgc-gold text-hgc-text text-xs font-bold shadow-lg">
                    <Ticket className="w-3.5 h-3.5" />
                    {upcomingLabel}
                  </span>
                </div>
              )}

              {/* Content overlay */}
              <div className="absolute bottom-0 left-0 right-0 p-8 z-10">
                <AnimatePresence mode="wait">
                  <motion.div
                    key={activeIndex}
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: -10 }}
                    transition={{ duration: 0.4 }}
                  >
                    <h3 className="text-hgc-surface font-bold text-xl lg:text-3xl mb-3 leading-snug max-w-xl">
                      {current.title}
                    </h3>

                    <div className="flex flex-wrap items-center gap-4 mb-5 text-hgc-surface/70 text-sm">
                      {current.location && (
                        <span className="inline-flex items-center gap-1.5">
                          <MapPin className="w-4 h-4 text-hgc-gold shrink-0" />
                          {current.location}
                        </span>
                      )}
                      {current.event_time && (
                        <span className="inline-flex items-center gap-1.5">
                          <Clock className="w-4 h-4 text-hgc-gold shrink-0" />
                          {current.event_time}
                        </span>
                      )}
                    </div>

                    <div className="flex items-center gap-3">
                      <Link
                        href={`/events/${current.slug}`}
                        className="group inline-flex items-center gap-1 text-hgc-surface text-sm font-medium hover:text-hgc-gold transition-colors"
                      >
                        {learnMoreLabel}
                        <ArrowRight className={`w-4 h-4 transition-transform ${isRtl ? "rotate-180" : ""}`} />
                      </Link>
                    </div>
                  </motion.div>
                </AnimatePresence>
              </div>

              {/* Navigation arrows */}
              <div className={`absolute bottom-6 z-10 flex items-center gap-2 ${isRtl ? "left-6" : "right-6"}`}>
                <button
                  onClick={prev}
                  className="w-10 h-10 rounded-full bg-hgc-surface/10 backdrop-blur-md border border-hgc-surface/20 flex items-center justify-center text-hgc-surface hover:bg-hgc-gold hover:border-hgc-gold hover:text-hgc-text transition-all duration-300"
                  aria-label="Previous"
                >
                  <ArrowLeft className="w-4 h-4" />
                </button>
                <button
                  onClick={next}
                  className="w-10 h-10 rounded-full bg-hgc-surface/10 backdrop-blur-md border border-hgc-surface/20 flex items-center justify-center text-hgc-surface hover:bg-hgc-gold hover:border-hgc-gold hover:text-hgc-text transition-all duration-300"
                  aria-label="Next"
                >
                  <ArrowRight className="w-4 h-4" />
                </button>
              </div>
            </div>
          </div>

          {/* Event List */}
          <div className="lg:col-span-5 order-2 lg:order-2 rtl:lg:order-1 flex flex-col gap-4">
            {events.map((event, idx) => {
              const isActive = idx === activeIndex;
              const dp = formatEventDate(event.event_date, lang);

              return (
                <button
                  key={event.id}
                  onClick={() => goTo(idx)}
                  className={`group relative flex items-start gap-4 p-4 rounded-2xl border text-start transition-all duration-500 ${
                    isActive
                      ? "bg-hgc-card border-hgc-gold/40 shadow-lg shadow-hgc-gold/5"
                      : "bg-hgc-card border-hgc-border hover:border-hgc-gold/20 hover:bg-hgc-card-hover"
                  }`}
                >
                  <div
                    className={`flex-shrink-0 w-16 h-16 rounded-xl flex flex-col items-center justify-center transition-colors duration-300 ${
                      isActive
                        ? "bg-hgc-gold text-hgc-text"
                        : "bg-hgc-card-alt text-hgc-text-muted group-hover:bg-hgc-gold/10 group-hover:text-hgc-gold"
                    }`}
                  >
                    <span className="text-lg font-black leading-none">{dp.day}</span>
                    <span className="text-[10px] font-bold uppercase tracking-wider mt-0.5">
                      {dp.month}
                    </span>
                  </div>

                  <div className="flex-1 min-w-0">
                    <h4
                      className={`font-bold text-sm mb-1.5 line-clamp-1 transition-colors ${
                        isActive ? "text-hgc-gold" : "text-hgc-text group-hover:text-hgc-gold"
                      }`}
                    >
                      {event.title}
                    </h4>
                    <div className="flex flex-wrap items-center gap-3 text-hgc-text-muted text-xs">
                      {event.location && (
                        <span className="inline-flex items-center gap-1">
                          <MapPin className="w-3 h-3 shrink-0" />
                          {event.location}
                        </span>
                      )}
                      {event.event_time && (
                        <span className="inline-flex items-center gap-1">
                          <Clock className="w-3 h-3 shrink-0" />
                          {event.event_time}
                        </span>
                      )}
                    </div>
                  </div>

                  {/* Active indicator */}
                  <div
                    className={`absolute top-1/2 -translate-y-1/2 w-1 h-10 rounded-full transition-all duration-300 ${
                      isActive ? "bg-hgc-gold opacity-100" : "bg-hgc-gold opacity-0"
                    } ${isRtl ? "right-0 rounded-l-full" : "left-0 rounded-r-full"}`}
                  />
                </button>
              );
            })}

            {/* Counter */}
            <div className="flex items-center justify-between mt-2 px-2">
              <span className="text-hgc-text-muted text-xs font-medium">
                {activeIndex + 1} / {total}
              </span>
              <div className="flex items-center gap-1.5">
                {events.map((_, idx) => (
                  <button
                    key={idx}
                    onClick={() => goTo(idx)}
                    className={`transition-all duration-300 rounded-full ${
                      idx === activeIndex
                        ? "w-6 h-1.5 bg-hgc-gold"
                        : "w-1.5 h-1.5 bg-hgc-border hover:bg-hgc-gold/50"
                    }`}
                  />
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}