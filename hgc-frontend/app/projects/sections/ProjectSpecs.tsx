"use client";

import { Wrench } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";

interface ProjectSpecsProps {
  project: any;
}

export default function ProjectSpecs({ project }: ProjectSpecsProps) {
  const { lang } = useI18n();

  if (!project.specifications) return null;

  return (
    <section className="relative py-20 lg:py-28 bg-[#0A1628] border-y border-white/5">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ScrollReveal className="text-center mb-16">
          <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-6">
            <Wrench className="w-4 h-4" />
            {lang === "en" ? "Technical Specifications" : lang === "dari" ? "مشخصات فنی" : "تخنیکي مشخصات"}
          </span>
          <h2 className="text-3xl lg:text-4xl font-bold text-white">
            {lang === "en" ? "Project Specifications" : lang === "dari" ? "مشخصات پروژه" : "د پروژې مشخصات"}
          </h2>
        </ScrollReveal>

        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          {project.specifications.map((spec: any, idx: number) => (
            <ScrollReveal key={idx} delay={idx * 0.05}>
              <div className="group p-6 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 transition-all duration-300">
                <p className="text-white/40 text-xs mb-2 uppercase tracking-wider">
                  {lang === "en" ? spec.label : spec.labelDari}
                </p>
                <p className="text-white text-xl font-bold group-hover:text-[#C9A227] transition-colors">
                  {spec.value}
                </p>
              </div>
            </ScrollReveal>
          ))}
        </div>
      </div>
    </section>
  );
}