"use client";

import { Building2, User, DollarSign, Tag } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/components/ScrollReveal";

interface ProjectOverviewProps {
  project: any;
}

export default function ProjectOverview({ project }: ProjectOverviewProps) {
  const { lang } = useI18n();

  const details = [
    { icon: Building2, labelEn: "Client", labelDari: "کارفرما", valueEn: project.client, valueDari: project.clientDari },
    { icon: User, labelEn: "Contractor", labelDari: "پیمانکار", valueEn: project.contractor, valueDari: project.contractorDari },
    { icon: DollarSign, labelEn: "Budget", labelDari: "بودجه", valueEn: project.budget, valueDari: project.budget },
    { icon: Tag, labelEn: "Category", labelDari: "دسته", valueEn: project.category, valueDari: project.categoryDari },
  ];

  return (
    <section className="relative py-20 lg:py-28 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-3 gap-12 lg:gap-16">
          {/* Main Content */}
          <div className="lg:col-span-2">
            <ScrollReveal>
              <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-6">
                {lang === "en" ? "Project Overview" : lang === "dari" ? "بررسی اجمالی پروژه" : "د پروژې لنډه کتنه"}
              </span>
            </ScrollReveal>

            <ScrollReveal delay={0.1}>
              <h2 className="text-3xl lg:text-4xl font-bold text-white mb-8">
                {lang === "en" ? "About This Project" : lang === "dari" ? "درباره این پروژه" : "د دې پروژې په اړه"}
              </h2>
            </ScrollReveal>

            <ScrollReveal delay={0.2}>
              <p className="text-lg text-white/60 leading-relaxed mb-8">
                {lang === "en" ? project.overviewEn : project.overviewDari}
              </p>
            </ScrollReveal>

            {/* Applications/Impact */}
            {project.applications && (
              <ScrollReveal delay={0.3}>
                <h3 className="text-xl font-bold text-white mb-6">
                  {lang === "en" ? "Key Impact Areas" : lang === "dari" ? "حوزه‌های کلیدی تأثیر" : "د اغیزې کلیدي ساحې"}
                </h3>
                <div className="grid sm:grid-cols-2 gap-4">
                  {project.applications.map((app: any, idx: number) => (
                    <div key={idx} className="flex items-start gap-4 p-5 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 transition-all">
                      <span className="text-2xl">{app.icon}</span>
                      <div>
                        <h4 className="text-white font-semibold mb-1">{lang === "en" ? app.titleEn : app.titleDari}</h4>
                        <p className="text-white/40 text-sm">{lang === "en" ? app.descEn : app.descDari}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </ScrollReveal>
            )}
          </div>

          {/* Sidebar Details */}
          <div className="lg:col-span-1">
            <ScrollReveal delay={0.2}>
              <div className="sticky top-24 space-y-4">
                <div className="p-6 rounded-2xl bg-white/[0.02] border border-white/5">
                  <h3 className="text-white font-bold mb-6">
                    {lang === "en" ? "Project Details" : lang === "dari" ? "جزئیات پروژه" : "د پروژې جزیات"}
                  </h3>
                  <div className="space-y-5">
                    {details.map((item, idx) => {
                      const Icon = item.icon;
                      return (
                        <div key={idx} className="flex items-start gap-3">
                          <div className="w-10 h-10 rounded-lg bg-[#C9A227]/10 flex items-center justify-center flex-shrink-0">
                            <Icon className="w-5 h-5 text-[#C9A227]" />
                          </div>
                          <div>
                            <p className="text-white/40 text-xs mb-0.5">{lang === "en" ? item.labelEn : item.labelDari}</p>
                            <p className="text-white text-sm font-medium">{lang === "en" ? item.valueEn : item.valueDari}</p>
                          </div>
                        </div>
                      );
                    })}
                  </div>
                </div>

                {/* CTA Card */}
                <div className="p-6 rounded-2xl bg-[#C9A227]/5 border border-[#C9A227]/10">
                  <h4 className="text-[#C9A227] font-bold mb-2">
                    {lang === "en" ? "Interested in similar projects?" : lang === "dari" ? "به پروژه‌های مشابه علاقه‌مندید؟" : "د ورته پروژو ته لیواله یاست؟"}
                  </h4>
                  <p className="text-white/40 text-sm mb-4">
                    {lang === "en" ? "Contact our team for a consultation." : lang === "dari" ? "برای مشاوره با تیم ما تماس بگیرید." : "د مشورې لپاره زموږ ټیم سره اړیکه ونیسئ."}
                  </p>
                  <a href="/contact" className="inline-flex items-center gap-2 px-5 py-2.5 bg-[#C9A227] text-[#0A1628] font-semibold rounded-lg text-sm hover:bg-[#C9A227]/90 transition-colors">
                    {lang === "en" ? "Get in Touch" : lang === "dari" ? "تماس بگیرید" : "اړیکه ونیسئ"}
                  </a>
                </div>
              </div>
            </ScrollReveal>
          </div>
        </div>
      </div>
    </section>
  );
}