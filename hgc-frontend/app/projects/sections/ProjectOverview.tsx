"use client";

import { Building2, User, Tag } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";

interface ProjectOverviewProps {
  project: any;
}

export default function ProjectOverview({ project }: ProjectOverviewProps) {
  const { lang } = useI18n();
  const isRTL = lang !== "en";

  const details = [
    { icon: Building2, labelEn: "Client", labelDari: "کارفرما", valueEn: project.client, valueDari: project.clientDari },
    { icon: User, labelEn: "Contractor", labelDari: "پیمانکار", valueEn: project.contractor, valueDari: project.contractorDari },
    { icon: Tag, labelEn: "Category", labelDari: "دسته", valueEn: project.category, valueDari: project.categoryDari },
  ];

  return (
    <section 
      className="relative py-20 lg:py-28" 
      style={{ backgroundColor: "#FFFFFF" }}
      dir={isRTL ? "rtl" : "ltr"}
    >
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-3 gap-12 lg:gap-16">
          <div className="lg:col-span-2">
            <ScrollReveal>
              <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium mb-6"
                style={{ backgroundColor: "rgba(212,175,55,0.10)", color: "#D4AF37" }}>
                {lang === "en" ? "Project Overview" : lang === "dari" ? "بررسی اجمالی پروژه" : "د پروژې لنډه کتنه"}
              </span>
            </ScrollReveal>
            <ScrollReveal delay={0.1}>
              <h2 className="text-3xl lg:text-4xl font-bold mb-8 text-start" style={{ color: "#0F172A" }}>
                {lang === "en" ? "About This Project" : lang === "dari" ? "درباره این پروژه" : "د دې پروژې په اړه"}
              </h2>
            </ScrollReveal>
            <ScrollReveal delay={0.2}>
              <p className="text-lg leading-relaxed mb-8 text-start" style={{ color: "#475569" }}>
                {lang === "en" ? project.overviewEn : project.overviewDari}
              </p>
            </ScrollReveal>
          </div>

          <div className="lg:col-span-1">
            <ScrollReveal delay={0.2}>
              <div className="sticky top-24 space-y-4">
                <div className="p-6 rounded-2xl" style={{ backgroundColor: "#F8FAFC", border: "1px solid #E2E8F0" }}>
                  <h3 className="font-bold mb-6 text-start" style={{ color: "#0F172A" }}>
                    {lang === "en" ? "Project Details" : lang === "dari" ? "جزئیات پروژه" : "د پروژې جزیات"}
                  </h3>
                  <div className="space-y-5">
                    {details.map((item, idx) => {
                      const Icon = item.icon;
                      return (
                        <div key={idx} className="flex items-start gap-3">
                          <div className="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0"
                            style={{ backgroundColor: "rgba(212,175,55,0.10)" }}>
                            <Icon className="w-5 h-5" style={{ color: "#D4AF37" }} />
                          </div>
                          <div>
                            <p className="text-xs mb-0.5 text-start" style={{ color: "#94A3B8" }}>
                              {lang === "en" ? item.labelEn : item.labelDari}
                            </p>
                            <p className="text-sm font-medium text-start" style={{ color: "#0F172A" }}>
                              {lang === "en" ? item.valueEn : item.valueDari}
                            </p>
                          </div>
                        </div>
                      );
                    })}
                  </div>
                </div>
              </div>
            </ScrollReveal>
          </div>
        </div>
      </div>
    </section>
  );
}