"use client";

import { CheckCircle2, Circle } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";

interface ProjectMilestonesProps {
  project: any;
}

export default function ProjectMilestones({ project }: ProjectMilestonesProps) {
  const { lang } = useI18n();

  const milestones = project.milestones || [];

  if (milestones.length === 0) return null;

  return (
    <section className="relative py-20 lg:py-28 bg-hgc-bg-alt border-y border-hgc-border">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <ScrollReveal className="text-center mb-16">
          <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-hgc-gold/10 text-hgc-gold text-sm font-medium mb-6">
            {lang === "en" ? "Timeline" : lang === "dari" ? "جدول زمانی" : "مهال ویش"}
          </span>
          <h2 className="text-3xl lg:text-4xl font-bold text-hgc-text">
            {lang === "en" ? "Project Milestones" : lang === "dari" ? "نقاط عطف پروژه" : "د پروژې مهمې پوښتنې"}
          </h2>
        </ScrollReveal>

        <div className="relative">
          {/* Vertical line */}
          <div className="absolute left-6 lg:left-1/2 lg:-translate-x-px top-0 bottom-0 w-[2px] bg-hgc-border" />

          {milestones.map((milestone: any, idx: number) => {
            const isLeft = idx % 2 === 0;
            const isCompleted = project.status === "completed" || idx < milestones.length - 1;

            return (
              <ScrollReveal key={idx} delay={idx * 0.1} direction={isLeft ? "left" : "right"}>
                <div className={`relative flex items-start gap-6 mb-12 last:mb-0 ${isLeft ? "lg:flex-row" : "lg:flex-row-reverse"}`}>
                  {/* Content */}
                  <div className={`flex-1 ml-16 lg:ml-0 ${isLeft ? "lg:pr-16 lg:text-right" : "lg:pl-16"}`}>
                    <span className="text-hgc-gold text-sm font-medium mb-1 block">
                      {milestone.date ? new Date(milestone.date).toLocaleDateString(lang === "en" ? "en-US" : "fa-AF", { year: "numeric", month: "long", day: "numeric" }) : ''}
                    </span>
                    <h3 className="text-lg font-bold text-hgc-text mb-2">
                      {lang === "en" ? milestone.titleEn : milestone.titleDari}
                    </h3>
                    <p className="text-hgc-text-muted text-sm">
                      {lang === "en" ? milestone.descEn : milestone.descDari}
                    </p>
                  </div>

                  {/* Center dot */}
                  <div className="absolute left-6 lg:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-hgc-bg border-2 z-10 mt-1.5"
                    style={{ borderColor: isCompleted ? "#D4AF37" : "#E2E8F0" }}
                  >
                    {isCompleted && <div className="w-1.5 h-1.5 rounded-full bg-hgc-gold absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" />}
                  </div>

                  <div className="hidden lg:block flex-1" />
                </div>
              </ScrollReveal>
            );
          })}
        </div>
      </div>
    </section>
  );
}