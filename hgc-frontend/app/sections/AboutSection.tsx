"use client";

import { useState, useEffect } from "react";
import Link from "next/link";
import Image from "next/image";
import {
  Award,
  ArrowRight,
  Loader2,
  Building2,
  Globe,
  TrendingUp,
  Users,
  Star,
  Heart,
  Zap,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { motion, Variants } from "framer-motion";

// ─── Types ─────────────────────────────────────────────────────────
interface AboutStory {
  sectionLabel: string;
  title: string;
  foundedYear: number;
  paragraphs: string[];
  mainImage: string;
  highlights: {
    icon: string;
    label: string;
    value: string;
  }[];
}

interface AboutCarouselSlide {
  image: string;
  title: string;
  location: string;
}

interface AboutData {
  story: AboutStory | null;
  carousel: AboutCarouselSlide[];
}

// ─── Icon Map ──────────────────────────────────────────────────────
const iconMap: Record<string, React.ElementType> = {
  Building2,
  Globe,
  TrendingUp,
  Users,
  Award,
  Star,
  Heart,
  Zap,
};

// ─── Framer Motion Variants ────────────────────────────────────────
const staggerContainer: Variants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.15, delayChildren: 0.1 },
  },
};

const staggerItem: Variants = {
  hidden: { opacity: 0, y: 30 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
  },
};

const imageStagger: Variants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.1, delayChildren: 0.3 },
  },
};

const imageScale: Variants = {
  hidden: { opacity: 0, scale: 0.9 },
  visible: {
    opacity: 1,
    scale: 1,
    transition: { duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
  },
};

// ─── Component ─────────────────────────────────────────────────────
export default function AboutSection() {
  const { lang } = useI18n();
  const isRtl = lang === "dari" || lang === "pashto";
  const [data, setData] = useState<AboutData | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchAbout = async () => {
      try {
        setError(null);
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/homepage-about?lang=${lang}`;
        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
          cache: "no-store",
        });

        if (!res.ok) {
          const text = await res.text();
          console.error("About API error response:", text.substring(0, 500));
          throw new Error(`HTTP ${res.status}: ${text.substring(0, 100)}`);
        }

        const json = await res.json();

        if (!json.success) {
          throw new Error(json.message || "API returned success: false");
        }

        const payload = json.data || {};
        const storyData = payload.story;

        let paragraphs: string[] = [];
        if (storyData?.paragraphs && Array.isArray(storyData.paragraphs)) {
          paragraphs = storyData.paragraphs;
        } else if (storyData?.paragraph_1) {
          paragraphs = [storyData.paragraph_1];
        }

        const normalizedStory: AboutStory | null = storyData
          ? {
            sectionLabel: storyData.sectionLabel || storyData.section_label || "",
            title: storyData.title || "",
            foundedYear: storyData.foundedYear || storyData.founded_year || 2001,
            paragraphs: paragraphs,
            mainImage: storyData.mainImage || storyData.main_image || "",
            highlights: Array.isArray(storyData.highlights)
              ? storyData.highlights.map((h: any) => ({
                icon: h.icon || h.icon_name || "Building2",
                label: h.label || h.label_en || "",
                value: h.value || h.value_text || "",
              }))
              : [],
          }
          : null;

        const normalizedData: AboutData = {
          story: normalizedStory,
          carousel: Array.isArray(payload.carousel) ? payload.carousel : [],
        };

        setData(normalizedData);
      } catch (err) {
        console.error("About fetch error:", err);
        setError(err instanceof Error ? err.message : "Unknown error");
        setData(null);
      } finally {
        setLoading(false);
      }
    };

    fetchAbout();
  }, [lang]);

  // ─── Loading State ───────────────────────────────────────────────
  if (loading) {
    return (
      <section className="py-28 bg-hgc-about-bg relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 flex items-center justify-center min-h-[400px]">
          <Loader2 className="w-8 h-8 text-hgc-about-gold animate-spin" />
        </div>
      </section>
    );
  }

  // ─── Error / No Data State ───────────────────────────────────────
  if (error || !data?.story) {
    return (
      <section className="py-28 bg-hgc-about-bg relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-4 flex flex-col items-center justify-center min-h-[400px] gap-4">
          <p className="text-hgc-about-text-muted text-sm">
            {error ? `Error: ${error}` : "No about data available"}
          </p>
          <button
            onClick={() => window.location.reload()}
            className="px-4 py-2 rounded-lg bg-hgc-about-gold/10 text-hgc-about-gold text-sm hover:bg-hgc-about-gold/20 transition-colors"
          >
            Retry
          </button>
        </div>
      </section>
    );
  }

  const { story, carousel } = data;

  // ─── Build Images ────────────────────────────────────────────────
  const mainImage = story.mainImage || "/images/placeholder.png";

  const carouselImages = Array.isArray(carousel)
    ? carousel.filter((s) => s.image && s.image !== mainImage).slice(0, 3)
    : [];

  return (
    <section
      className="py-28 bg-hgc-about-bg relative overflow-hidden"
      dir={isRtl ? "rtl" : "ltr"}
    >
      {/* Animated background blobs */}
      <div className="absolute top-20 right-0 w-[500px] h-[500px] bg-hgc-about-gold/[0.03] rounded-full blur-[100px] animate-pulse" />
      <div className="absolute bottom-0 left-0 w-[400px] h-[400px] bg-hgc-navy/[0.03] rounded-full blur-[100px]" />

      {/* Subtle grid pattern */}
      <div
        className="absolute inset-0 opacity-[0.02]"
        style={{
          backgroundImage:
            "linear-gradient(rgba(212,175,55,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(212,175,55,0.3) 1px, transparent 1px)",
          backgroundSize: "60px 60px",
        }}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="grid lg:grid-cols-12 gap-12 lg:gap-8 items-start">
          {/* ─── Text Content ──────────────────────────────────────── */}
          <div className="lg:col-span-5 order-2 lg:order-1 rtl:lg:order-2">
            <motion.div
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: "-100px" }}
              variants={staggerContainer}
              className="space-y-6"
            >
              {/* Badge */}
              <motion.div
                variants={staggerItem}
                className="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-hgc-about-gold/10 border border-hgc-about-gold/20 text-hgc-about-gold text-sm font-semibold backdrop-blur-sm"
              >
                <Award className="w-4 h-4" />
                {story.sectionLabel}
              </motion.div>

              {/* Heading */}
              <motion.h2
                variants={staggerItem}
                className="text-4xl lg:text-[3.25rem] font-bold text-hgc-about-text leading-[1.15] tracking-tight"
              >
                {story.title}
              </motion.h2>

              {/* Description Paragraphs */}
              {story.paragraphs && story.paragraphs.length > 0 ? (
                <motion.div
                  variants={staggerItem}
                  className="story-content text-hgc-about-text-secondary leading-relaxed space-y-4"
                >
                  {story.paragraphs.map((paragraph, idx) => (
                    <div
                      key={idx}
                      dangerouslySetInnerHTML={{ __html: paragraph }}
                    />
                  ))}
                </motion.div>
              ) : (
                <motion.p
                  variants={staggerItem}
                  className="text-hgc-about-text-muted text-sm italic"
                >
                  No content available.
                </motion.p>
              )}

              {/* Highlights / Stats Row */}
              {story.highlights && story.highlights.length > 0 && (
                <motion.div
                  variants={staggerItem}
                  className="grid grid-cols-3 gap-4 pt-4"
                >
                  {story.highlights.map((highlight, idx) => {
                    const Icon = iconMap[highlight.icon] || Building2;
                    return (
                      <div
                        key={idx}
                        className="relative rounded-xl bg-hgc-about-card-bg border border-hgc-about-card-border p-4 text-center group hover:bg-hgc-about-card-hover hover:border-hgc-about-gold/30 transition-all duration-300"
                      >
                        <div className="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-hgc-about-gold/10 mb-2 group-hover:bg-hgc-about-gold/20 transition-colors">
                          <Icon className="w-5 h-5 text-hgc-about-gold" />
                        </div>
                        <div className="text-2xl font-bold text-hgc-about-text mb-0.5">
                          {highlight.value}
                        </div>
                        <div className="text-hgc-about-text-muted text-xs font-medium leading-tight">
                          {highlight.label}
                        </div>
                      </div>
                    );
                  })}
                </motion.div>
              )}

              {/* CTA */}
              <motion.div variants={staggerItem} className="pt-2">
                <Link
                  href="/about"
                  className="group inline-flex items-center gap-3 bg-hgc-about-gold text-hgc-about-text px-7 py-3.5 rounded-xl font-bold text-sm hover:bg-hgc-about-gold-bright transition-all duration-300 shadow-lg shadow-hgc-about-gold/20 hover:shadow-hgc-about-gold/30 hover:-translate-y-0.5"
                >
                  {lang === "en"
                    ? "Explore Our Story"
                    : lang === "dari"
                      ? "با داستان ما آشنا شوید"
                      : "زموږ له کیسې سره وپیژنئ"}
                  <ArrowRight
                    className={`w-4 h-4 transition-transform duration-300 ${
                      isRtl
                        ? "rotate-180 group-hover:-translate-x-1"
                        : "group-hover:translate-x-1"
                    }`}
                  />
                </Link>
              </motion.div>
            </motion.div>
          </div>

          {/* ─── Image Area ────────────────────────────────────────── */}
          <div className="lg:col-span-7 order-1 lg:order-2 rtl:lg:order-1 relative">
            <motion.div
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: "-50px" }}
              variants={imageStagger}
              className="relative"
            >
              {/* Main large image from DB */}
              <motion.div
                variants={imageScale}
                className="relative aspect-[16/10] rounded-3xl overflow-hidden shadow-2xl shadow-hgc-about-overlay/20 group"
              >
                <Image
                  src={mainImage}
                  alt={story.title}
                  fill
                  className="object-cover transition-transform duration-1000 group-hover:scale-105"
                  sizes="(max-width: 1024px) 100vw, 60vw"
                  priority
                />
                {/* Cinematic overlay */}
                <div className="absolute inset-0 bg-gradient-to-t from-hgc-about-overlay/60 via-hgc-about-overlay/20 to-transparent opacity-60" />
                <div
                  className={`absolute inset-0 ${
                    isRtl ? "bg-gradient-to-l" : "bg-gradient-to-r"
                  } from-hgc-about-overlay/40 to-transparent`}
                />
              </motion.div>

              {/* Secondary images from carousel */}
              {carouselImages.length > 0 && (
                <div className="grid grid-cols-3 gap-3 mt-3">
                  {carouselImages.map((slide, i) => (
                    <motion.div
                      key={i}
                      variants={imageScale}
                      className="relative aspect-[4/3] rounded-2xl overflow-hidden group"
                    >
                      <Image
                        src={slide.image}
                        alt="Project"
                        fill
                        className="object-cover transition-transform duration-700 group-hover:scale-110"
                        sizes="(max-width: 1024px) 33vw, 20vw"
                      />
                      <div className="absolute inset-0 bg-hgc-about-overlay/20 group-hover:bg-hgc-about-overlay/5 transition-colors duration-500" />
                    </motion.div>
                  ))}
                </div>
              )}

              {/* Decorative elements */}
              <div
                className={`absolute -top-6 w-32 h-32 border border-hgc-about-gold/10 rounded-full pointer-events-none ${
                  isRtl ? "-left-6" : "-right-6"
                }`}
              />
              <div
                className={`absolute -top-6 w-24 h-24 border border-hgc-about-gold/20 rounded-full pointer-events-none ${
                  isRtl ? "-left-6" : "-right-6"
                }`}
              />
              <div
                className={`absolute -bottom-8 w-2 h-2 bg-hgc-about-gold rounded-full animate-ping pointer-events-none ${
                  isRtl ? "left-12" : "right-12"
                }`}
              />
              <div
                className={`absolute top-1/2 w-1.5 h-16 bg-hgc-about-gold/20 rounded-full pointer-events-none ${
                  isRtl ? "-left-3" : "-right-3"
                }`}
              />
            </motion.div>
          </div>
        </div>
      </div>
    </section>
  );
}