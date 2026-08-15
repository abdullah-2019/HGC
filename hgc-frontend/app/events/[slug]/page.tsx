"use client";

import { useParams } from "next/navigation";
import Link from "next/link";
import Image from "next/image";
import { useState, useEffect } from "react";
import { useI18n } from "@/components/useI18nStore";
import { ArrowLeft, ArrowRight, Calendar, MapPin, Clock, Loader2 } from "lucide-react";

interface EventDetail {
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

export default function EventDetailPage() {
  const { lang, dir } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const params = useParams();
  const slug = params.slug as string;

  const [event, setEvent] = useState<EventDetail | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (!slug) return;
    const fetchEvent = async () => {
      try {
        setLoading(true);
        const res = await fetch(
          `${process.env.NEXT_PUBLIC_API_URL}/api/events/${slug}?lang=${lang}`,
          { headers: { Accept: "application/json" } }
        );
        if (!res.ok) throw new Error("Failed to fetch");
        const json = await res.json();
        if (json.success) setEvent(json.data);
      } catch (err) {
        console.error("Event detail fetch error:", err);
      } finally {
        setLoading(false);
      }
    };
    fetchEvent();
  }, [slug, lang]);

  const formatDate = (dateStr: string) => {
    const date = new Date(dateStr);
    if (lang === "en")
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    if (lang === "dari")
      return date.toLocaleDateString("fa-AF", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    return date.toLocaleDateString("ps-AF", {
      year: "numeric",
      month: "long",
      day: "numeric",
    });
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-hgc-bg flex items-center justify-center">
        <Loader2 className="w-10 h-10 text-hgc-gold animate-spin" />
      </div>
    );
  }

  if (!event) {
    return (
      <div className="min-h-screen bg-hgc-bg flex items-center justify-center text-hgc-text-muted">
        {lang === "en"
          ? "Event not found."
          : lang === "dari"
            ? "رویداد یافت نشد."
            : "پیښه ونه موندل شوه."}
      </div>
    );
  }

  return (
    <article dir={dir} className="min-h-screen bg-hgc-bg">
      {/* Hero Image */}
      <div className="relative h-[50vh] lg:h-[60vh] w-full">
        {event.cover_image ? (
          <Image
            src={event.cover_image}
            alt={event.title}
            fill
            className="object-cover"
            priority
          />
        ) : (
          <div className="absolute inset-0 bg-gradient-to-br from-[#0F2B5B] to-[#1a1a2e]" />
        )}
        <div className="absolute inset-0 bg-gradient-to-t from-hgc-bg via-hgc-bg/60 to-transparent" />
        <div className={`absolute inset-0 ${isRtl ? "bg-gradient-to-l" : "bg-gradient-to-r"} from-hgc-bg/40 to-transparent`} />
      </div>

      {/* Content */}
      <div className="max-w-4xl mx-auto px-4 sm:px-6 -mt-32 relative z-10 pb-24">
        <Link
          href="/"
          className="inline-flex items-center gap-2 text-hgc-gold hover:text-hgc-gold-bright transition-colors mb-8"
        >
          {isRtl ? <ArrowRight className="w-4 h-4" /> : <ArrowLeft className="w-4 h-4" />}
          {lang === "en"
            ? "Back to Home"
            : lang === "dari"
              ? "بازگشت به صفحه اصلی"
              : "بیرته کور پاڼې ته"}
        </Link>

        <div className="flex flex-wrap items-center gap-4 mb-6">
          <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-hgc-gold/10 text-hgc-gold text-sm font-medium border border-hgc-gold/20">
            <Calendar className="w-3.5 h-3.5" />
            {formatDate(event.event_date)}
          </span>
          {event.is_upcoming && (
            <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-green-900/50 text-green-400 text-sm font-medium border border-green-800">
              {lang === "en" ? "Upcoming" : lang === "dari" ? "پیش رو" : "راتلونکی"}
            </span>
          )}
        </div>

        <h1 className="text-3xl lg:text-5xl font-bold text-hgc-text mb-8 leading-tight text-start">
          {event.title}
        </h1>

        <div className="flex flex-wrap items-center gap-6 mb-10 text-hgc-text-muted">
          {event.location && (
            <span className="inline-flex items-center gap-2">
              <MapPin className="w-4 h-4 text-hgc-gold" />
              {event.location}
            </span>
          )}
          {event.event_time && (
            <span className="inline-flex items-center gap-2">
              <Clock className="w-4 h-4 text-hgc-gold" />
              {event.event_time}
            </span>
          )}
        </div>

        <div className="prose prose-invert prose-lg max-w-none text-hgc-text/80 leading-relaxed text-start">
          <p>{event.description}</p>
        </div>
      </div>
    </article>
  );
}