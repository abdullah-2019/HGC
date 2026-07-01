"use client";

import React, { useState, useEffect } from "react";
import {
  Building2,
  ArrowLeft,
  Loader2,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import Link from "next/link";

import CompanyProfileHero from "./sections/CompanyProfileHero";
import CompanyAbout from "./sections/CompanyAbout";
import CompanyMissionVision from "./sections/CompanyMissionVision";
import CompanyStats from "./sections/CompanyStats";
import CompanyValues from "./sections/CompanyValues";
import CompanyHistory from "./sections/CompanyHistory";
import CompanyLeadership from "./sections/CompanyLeadership";
import CompanyAwards from "./sections/CompanyAwards";

import { iconMap } from "@/components/company/iconMap";

interface CompanyProfile {
  id: number;
  slug: string;
  name: string;
  short_name: string;
  tagline: string | null;
  description: string;
  sector: string | null;
  about: string | null;
  mission: string | null;
  vision: string | null;
  accent_color: string;
  secondary_color: string | null;
  icon_name: string;
  logo_url: string | null;
  hero_image_url: string | null;
  contact: {
    email: string | null;
    phone: string | null;
    address: string | null;
    latitude: string | null;
    longitude: string | null;
  };
  web: {
    website: string | null;
    facebook: string | null;
    linkedin: string | null;
    twitter: string | null;
    instagram: string | null;
  };
  details: {
    established_year: number | null;
    founded_year: number | null;
    registration_number: string | null;
    tax_id: string | null;
    employee_count: number | null;
  };
  seo: {
    title: string | null;
    description: string | null;
  };
}

export default function CompanyProfileClient({ slug }: { slug: string }) {
  const { lang, dir } = useI18n();
  const [company, setCompany] = useState<CompanyProfile | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchCompany = async () => {
      setLoading(true);
      setError(null);

      try {
        const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/companies/${slug}/profile?lang=${lang}`;
        const res = await fetch(apiUrl, {
          headers: { Accept: "application/json" },
          cache: "no-store",
        });

        if (!res.ok) {
          if (res.status === 404) {
            throw new Error(
              lang === "en"
                ? "Company not found"
                : lang === "dari"
                ? "شرکت یافت نشد"
                : "شرکت ونه موندل شو"
            );
          }
          throw new Error(`HTTP ${res.status}`);
        }

        const contentType = res.headers.get("content-type");
        if (!contentType?.includes("application/json")) {
          const text = await res.text();
          throw new Error(`Expected JSON, got HTML: ${text.substring(0, 100)}`);
        }

        const json = await res.json();
        if (!json.success) {
          throw new Error(json.message || "Failed to load company");
        }

        setCompany(json.data);
      } catch (err) {
        console.error("Company profile error:", err);
        setError(err instanceof Error ? err.message : "Unknown error");
      } finally {
        setLoading(false);
      }
    };

    fetchCompany();
  }, [slug, lang]);

  if (loading) {
    return (
      <div className="min-h-screen bg-[#0A1628] flex items-center justify-center">
        <div className="text-center">
          <Loader2 className="w-10 h-10 text-[#C9A227] animate-spin mx-auto mb-4" />
          <p className="text-white/50 text-sm">
            {lang === "en"
              ? "Loading company profile..."
              : lang === "dari"
              ? "در حال بارگذاری پروفایل شرکت..."
              : "د شرکت پروفایل بارول کیږي..."}
          </p>
        </div>
      </div>
    );
  }

  if (error || !company) {
    const Icon = iconMap.Building2;
    return (
      <div className="min-h-screen bg-[#0A1628] flex items-center justify-center px-4">
        <div className="text-center max-w-md">
          <div className="w-16 h-16 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-6">
            <Icon className="w-8 h-8 text-red-400" />
          </div>
          <h2 className="text-white text-xl font-bold mb-2">
            {lang === "en"
              ? "Company Not Found"
              : lang === "dari"
              ? "شرکت یافت نشد"
              : "شرکت ونه موندل شو"}
          </h2>
          <p className="text-white/40 text-sm mb-6">{error}</p>
          <Link
            href="/"
            className="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#C9A227]/10 border border-[#C9A227]/20 text-[#C9A227] hover:bg-[#C9A227]/20 transition-all text-sm font-medium"
          >
            <ArrowLeft className="w-4 h-4" />
            {lang === "en"
              ? "Back to Home"
              : lang === "dari"
              ? "بازگشت به صفحه اصلی"
              : "بیرته کور ته"}
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-[#0A1628]" dir={dir}>
      <CompanyProfileHero company={company} />
      <CompanyAbout company={company} />
      <CompanyMissionVision company={company} />
      <CompanyStats company={company} />
      <CompanyValues company={company} />
      <CompanyHistory company={company} />
      <CompanyLeadership company={company} />
      <CompanyAwards company={company} />
    </div>
  );
}