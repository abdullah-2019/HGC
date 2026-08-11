// app/about/page.tsx

import { Metadata } from "next";
import AboutPageClient from "./AboutPageClient";

// ─── Types matching Laravel API response ─────────────────

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

interface AboutSettings {
  hero: {
    backgroundImage: string;
    label: LocalizedText;
    title: LocalizedText;
    subtitle: LocalizedText;
  };
  meta: {
    title: LocalizedText;
    description: LocalizedText;
  };
}

interface AboutStoryHighlight {
  icon: string;
  label: LocalizedText;
  value: string;
}

interface AboutStory {
  sectionLabel: LocalizedText;
  title: LocalizedText;
  foundedYear: number;
  paragraphs: LocalizedText[];
  mainImage: string;
  floatingCard: {
    value: string;
    label: LocalizedText;
  };
  highlights: AboutStoryHighlight[];
}

interface AboutStat {
  key: string;
  value: number;
  suffix: string;
  label: LocalizedText;
  icon: string;
}

interface AboutCarouselSlide {
  image: string;
  title: LocalizedText;
  location: LocalizedText;
}

interface AboutMissionPoint {
  text: LocalizedText;
}

interface AboutMission {
  sectionLabel: LocalizedText;
  title: LocalizedText;
  description: LocalizedText;
  image: string;
  quote: LocalizedText;
  points: AboutMissionPoint[];
}

interface AboutVisionPillar {
  icon: string;
  title: LocalizedText;
  description: LocalizedText;
}

interface AboutVision {
  sectionLabel: LocalizedText;
  title: LocalizedText;
  description: LocalizedText;
  image: string;
  badge: {
    value: string;
    label: LocalizedText;
  };
  pillars: AboutVisionPillar[];
}

interface AboutCoreValue {
  icon: string;
  title: LocalizedText;
  description: LocalizedText;
}

interface AboutCoreValues {
  sectionLabel: LocalizedText;
  sectionTitle: LocalizedText;
  sectionDescription: LocalizedText;
  values: AboutCoreValue[];
}

export interface AboutPageData {
  settings: AboutSettings | null;
  story: AboutStory | null;
  stats: AboutStat[];
  carousel: AboutCarouselSlide[];
  mission: AboutMission | null;
  vision: AboutVision | null;
  coreValues: AboutCoreValues | null;
}

// ─── API Response wrapper ───────────────────────────────
interface ApiResponse<T> {
  success: boolean;
  message: string;
  data: T;
}

// ─── Fetch function ─────────────────────────────────────

async function fetchAboutPageData(): Promise<AboutPageData> {
  const baseUrl = process.env.NEXT_PUBLIC_API_URL?.replace(/\/$/, "") || "https://api.hgc.af/";
  const API_BASE = `${baseUrl}/api`;
  const isDev = process.env.NODE_ENV === "development";

  // Cache-busting query param to bypass both Laravel & Next.js cache in dev
  const cacheBuster = isDev ? `?_t=${Date.now()}` : "";

  const fetchOptions: RequestInit = {
    ...(isDev
      ? { cache: "no-store" as const }
      : { next: { revalidate: 60, tags: ["about-page"] } }
    ),
    headers: {
      Accept: "application/json",
      ...(isDev ? { "X-Skip-Cache": "true" } : {}),
    },
  };

  try {
    const res = await fetch(`${API_BASE}/about${cacheBuster}`, fetchOptions);

    if (!res.ok) {
      const errorBody = await res.text();
      console.error("API Error Response:", errorBody);
      throw new Error(`Failed to fetch about page data: ${res.status}`);
    }

    const json = (await res.json()) as ApiResponse<AboutPageData>;

    // Handle both wrapped {success, data} and unwrapped responses
    const responseData = json.data ?? (json as unknown as AboutPageData);

    // Ensure stats is always an array
    if (responseData.stats && !Array.isArray(responseData.stats)) {
      console.warn("[AboutPage] stats is not an array, converting:", responseData.stats);
      responseData.stats = [];
    }

    if (isDev) {
      console.log("[AboutPage] API Response keys:", Object.keys(responseData || {}));
      console.log("[AboutPage] stats count:", responseData.stats?.length);
    }

    return responseData;
  } catch (error) {
    console.error("Error fetching about page data:", error);
    return {
      settings: null,
      story: null,
      stats: [],
      carousel: [],
      mission: null,
      vision: null,
      coreValues: null,
    };
  }
}

// ─── Metadata ───────────────────────────────────────────

export async function generateMetadata(): Promise<Metadata> {
  const data = await fetchAboutPageData();
  const meta = data.settings?.meta;

  return {
    title: meta?.title?.en || "About Us | Hafez Group of Companies",
    description:
      meta?.description?.en ||
      "Discover Hafez Group of Companies — Afghanistan's leading conglomerate since 2001.",
    openGraph: {
      title: meta?.title?.en || "About Us | Hafez Group of Companies",
      description: meta?.description?.en || "",
      type: "website",
    },
  };
}

// ─── Page Component ─────────────────────────────────────

export default async function AboutPage() {
  const data = await fetchAboutPageData();

  if (process.env.NODE_ENV === "development") {
    console.log("[AboutPage] data.settings:", data.settings ? "present" : "null");
    console.log("[AboutPage] data.story:", data.story ? "present" : "null");
    console.log("[AboutPage] data.stats:", Array.isArray(data.stats) ? `array[${data.stats.length}]` : typeof data.stats);
    console.log("[AboutPage] data.carousel:", Array.isArray(data.carousel) ? `array[${data.carousel.length}]` : typeof data.carousel);
    console.log("[AboutPage] data.mission:", data.mission ? "present" : "null");
    console.log("[AboutPage] data.vision:", data.vision ? "present" : "null");
    console.log("[AboutPage] data.coreValues:", data.coreValues ? "present" : "null");
  }

  return <AboutPageClient data={data} />;
}