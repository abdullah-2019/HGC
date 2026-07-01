// "use client";

// import { motion } from "framer-motion";
// import { useI18n } from "@/components/useI18nStore";
// import { t } from "@/components/translations";

// interface TimelineEvent {
//   year: string;
//   title: string;
//   desc: string;
// }

// export default function CompanyHistory() {
//   const { lang, dir } = useI18n();

//   const events: TimelineEvent[] = [
//     { year: "2001", title: t(lang, "profile.hist_2001_title"), desc: t(lang, "profile.hist_2001_desc") },
//     { year: "2005", title: t(lang, "profile.hist_2005_title"), desc: t(lang, "profile.hist_2005_desc") },
//     { year: "2008", title: t(lang, "profile.hist_2008_title"), desc: t(lang, "profile.hist_2008_desc") },
//     { year: "2012", title: t(lang, "profile.hist_2012_title"), desc: t(lang, "profile.hist_2012_desc") },
//     { year: "2015", title: t(lang, "profile.hist_2015_title"), desc: t(lang, "profile.hist_2015_desc") },
//     { year: "2018", title: t(lang, "profile.hist_2018_title"), desc: t(lang, "profile.hist_2018_desc") },
//     { year: "2021", title: t(lang, "profile.hist_2021_title"), desc: t(lang, "profile.hist_2021_desc") },
//     { year: "2024", title: t(lang, "profile.hist_2024_title"), desc: t(lang, "profile.hist_2024_desc") },
//   ];

//   return (
//     <section className="py-20 bg-[#070F1A]" dir={dir}>
//       <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
//         <motion.div
//           initial={{ opacity: 0, y: 30 }}
//           whileInView={{ opacity: 1, y: 0 }}
//           viewport={{ once: true }}
//           className="mb-16 text-center"
//         >
//           <div className="mb-4 inline-flex items-center gap-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 px-4 py-2 text-[#C9A227]">
//             <span className="text-sm font-medium">{t(lang, "profile.history_badge")}</span>
//           </div>
//           <h2 className="text-3xl font-bold text-white md:text-4xl">
//             {t(lang, "profile.history_title")}
//           </h2>
//         </motion.div>

//         <div className="relative">
//           {/* Center Line */}
//           <div className="absolute left-1/2 top-0 h-full w-px -translate-x-1/2 bg-gradient-to-b from-[#C9A227]/50 via-[#C9A227]/20 to-transparent hidden md:block" />

//           <div className="space-y-12">
//             {events.map((event, index) => {
//               const isLeft = index % 2 === 0;
//               return (
//                 <motion.div
//                   key={event.year}
//                   initial={{ opacity: 0, y: 30 }}
//                   whileInView={{ opacity: 1, y: 0 }}
//                   viewport={{ once: true }}
//                   transition={{ duration: 0.6, delay: index * 0.1 }}
//                   className={`relative flex items-center gap-8 ${
//                     isLeft ? "md:flex-row" : "md:flex-row-reverse"
//                   } flex-col`}
//                 >
//                   {/* Content Card */}
//                   <div className={`flex-1 ${isLeft ? "md:text-right" : "md:text-left"} text-center`}>
//                     <div
//                       className={`inline-block rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-[#C9A227]/30 ${
//                         dir === "rtl" ? (isLeft ? "md:text-left" : "md:text-right") : ""
//                       }`}
//                     >
//                       <span className="inline-block mb-2 rounded-lg bg-[#C9A227]/15 px-3 py-1 text-sm font-bold text-[#C9A227]">
//                         {event.year}
//                       </span>
//                       <h3 className="mb-2 text-lg font-bold text-white">{event.title}</h3>
//                       <p className="text-white/60 text-sm leading-relaxed">{event.desc}</p>
//                     </div>
//                   </div>

//                   {/* Center Dot */}
//                   <div className="relative z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#C9A227] shadow-lg shadow-[#C9A227]/30 hidden md:flex">
//                     <div className="h-4 w-4 rounded-full bg-[#0A1628]" />
//                   </div>

//                   {/* Spacer */}
//                   <div className="flex-1 hidden md:block" />
//                 </motion.div>
//               );
//             })}
//           </div>
//         </div>
//       </div>
//     </section>
//   );
// }

"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { useState } from "react";

interface TimelineEvent {
  year: string;
  title: string;
  desc: string;
}

interface CompanyHistoryProps {
  company: {
    name: string;
    accent_color: string;
    details: {
      established_year: number | null;
      founded_year: number | null;
    };
  };
}

export default function CompanyHistory({ company }: CompanyHistoryProps) {
  const { lang, dir } = useI18n();
  const startYear = company.details.established_year || company.details.founded_year || 2001;

  // Generate timeline based on company start year
  const generateTimeline = (): TimelineEvent[] => {
    const events: TimelineEvent[] = [];
    const currentYear = new Date().getFullYear();
    const step = Math.max(3, Math.floor((currentYear - startYear) / 6));

    for (let i = 0; i <= 6; i++) {
      const year = startYear + i * step;
      if (year > currentYear) break;

      events.push({
        year: year.toString(),
        title:
          lang === "en"
            ? `Milestone ${i + 1}`
            : lang === "dari"
            ? `نقطه عطف ${i + 1}`
            : `نقطه ${i + 1}`,
        desc:
          lang === "en"
            ? `A significant achievement for ${company.name} in ${year}.`
            : lang === "dari"
            ? `یک دستاورد مهم برای ${company.name} در سال ${year}.`
            : `د ${company.name} لپاره په ${year} کې یو مهم لاسته راوړنه.`,
      });
    }

    return events;
  };

  const events = generateTimeline();

  return (
    <section className="py-20 bg-[#070F1A]" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mb-16 text-center"
        >
          <div
            className="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium"
            style={{
              backgroundColor: `${company.accent_color}15`,
              color: company.accent_color,
              border: `1px solid ${company.accent_color}30`,
            }}
          >
            {lang === "en" ? "Our Journey" : lang === "dari" ? "سفر ما" : "زموږ سفر"}
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {lang === "en"
              ? `History of ${company.name}`
              : lang === "dari"
              ? `تاریخچه ${company.name}`
              : `د ${company.name} تاریخ`}
          </h2>
        </motion.div>

        <div className="relative">
          <div
            className="absolute left-1/2 top-0 h-full w-px -translate-x-1/2 hidden md:block"
            style={{
              background: `linear-gradient(to bottom, ${company.accent_color}80, ${company.accent_color}20, transparent)`,
            }}
          />

          <div className="space-y-12">
            {events.map((event, index) => {
              const isLeft = index % 2 === 0;
              return (
                <motion.div
                  key={event.year}
                  initial={{ opacity: 0, y: 30 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  className={`relative flex items-center gap-8 ${
                    isLeft ? "md:flex-row" : "md:flex-row-reverse"
                  } flex-col`}
                >
                  <div
                    className={`flex-1 ${
                      isLeft ? "md:text-right" : "md:text-left"
                    } text-center`}
                  >
                    <div className="inline-block rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-white/20">
                      <span
                        className="inline-block mb-2 rounded-lg px-3 py-1 text-sm font-bold"
                        style={{
                          backgroundColor: `${company.accent_color}20`,
                          color: company.accent_color,
                        }}
                      >
                        {event.year}
                      </span>
                      <h3 className="mb-2 text-lg font-bold text-white">{event.title}</h3>
                      <p className="text-white/60 text-sm leading-relaxed">{event.desc}</p>
                    </div>
                  </div>

                  <div
                    className="relative z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-full shadow-lg hidden md:flex"
                    style={{
                      backgroundColor: company.accent_color,
                      boxShadow: `0 0 20px ${company.accent_color}40`,
                    }}
                  >
                    <div className="h-4 w-4 rounded-full bg-[#0A1628]" />
                  </div>

                  <div className="flex-1 hidden md:block" />
                </motion.div>
              );
            })}
          </div>
        </div>
      </div>
    </section>
  );
}