// "use client";

// import { motion } from "framer-motion";
// import { useI18n } from "@/components/useI18nStore";
// import { t } from "@/components/translations";
// import { Mail } from "lucide-react";

// interface Leader {
//   name: string;
//   role: string;
//   image: string;
//   bio: string;
// }

// export default function CompanyLeadership() {
//   const { lang, dir } = useI18n();

//   const leaders: Leader[] = [
//     {
//       name: t(lang, "profile.leader1_name"),
//       role: t(lang, "profile.leader1_role"),
//       image: "/images/placeholder.png",
//       bio: t(lang, "profile.leader1_bio"),
//     },
//     {
//       name: t(lang, "profile.leader2_name"),
//       role: t(lang, "profile.leader2_role"),
//       image: "/images/placeholder.png",
//       bio: t(lang, "profile.leader2_bio"),
//     },
//     {
//       name: t(lang, "profile.leader3_name"),
//       role: t(lang, "profile.leader3_role"),
//       image: "/images/placeholder.png",
//       bio: t(lang, "profile.leader3_bio"),
//     },
//     {
//       name: t(lang, "profile.leader4_name"),
//       role: t(lang, "profile.leader4_role"),
//       image: "/images/placeholder.png",
//       bio: t(lang, "profile.leader4_bio"),
//     },
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
//             <span className="text-sm font-medium">{t(lang, "profile.leadership_badge")}</span>
//           </div>
//           <h2 className="text-3xl font-bold text-white md:text-4xl">
//             {t(lang, "profile.leadership_title")}
//           </h2>
//         </motion.div>

//         <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
//           {leaders.map((leader, index) => (
//             <motion.div
//               key={leader.name}
//               initial={{ opacity: 0, y: 30 }}
//               whileInView={{ opacity: 1, y: 0 }}
//               viewport={{ once: true }}
//               transition={{ duration: 0.5, delay: index * 0.1 }}
//               className="group rounded-2xl bg-white/5 border border-white/10 overflow-hidden transition-all hover:-translate-y-2 hover:bg-white/10 hover:border-[#C9A227]/30"
//             >
//               <div className="relative h-64 overflow-hidden">
//                 <img
//                   src={leader.image}
//                   alt={leader.name}
//                   className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
//                 />
//                 <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628] via-transparent to-transparent" />
                
//                 {/* Social Links */}
//                 <div className="absolute top-4 right-4 flex gap-2 opacity-0 transition-opacity group-hover:opacity-100">
//                   <a href="#" className="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 backdrop-blur-sm text-white hover:bg-[#C9A227] hover:text-[#0A1628] transition-colors">
//                     {/* <Linkedin size={16} /> */} linkedIn
//                   </a>
//                   <a href="#" className="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 backdrop-blur-sm text-white hover:bg-[#C9A227] hover:text-[#0A1628] transition-colors">
//                     <Mail size={16} />
//                   </a>
//                 </div>
//               </div>

//               <div className="p-6">
//                 <h3 className="mb-1 text-lg font-bold text-white">{leader.name}</h3>
//                 <p className="mb-3 text-sm text-[#C9A227] font-medium">{leader.role}</p>
//                 <p className="text-white/50 text-sm leading-relaxed">{leader.bio}</p>
//               </div>
//             </motion.div>
//           ))}
//         </div>
//       </div>
//     </section>
//   );
// }

"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { Mail } from "lucide-react";

interface Leader {
  name: string;
  role: string;
  image: string;
  bio: string;
  linkedin?: string;
  email?: string;
}

interface CompanyLeadershipProps {
  company: {
    name: string;
    accent_color: string;
  };
}

export default function CompanyLeadership({ company }: CompanyLeadershipProps) {
  const { lang, dir } = useI18n();

  // This would ideally come from a separate API endpoint for leadership
  // For now, using placeholder data that can be replaced with real API data
  const leaders: Leader[] = [
    {
      name: lang === "en" ? "CEO Name" : lang === "dari" ? "نام مدیرعامل" : "د CEO نوم",
      role: lang === "en" ? "Chief Executive Officer" : lang === "dari" ? "مدیرعامل" : "اجرایوي ریس",
      image: "/images/placeholder.png",
      bio: lang === "en"
        ? `Leading ${company.name} with vision and strategic direction.`
        : lang === "dari"
        ? `رهبری ${company.name} با چشم‌انداز و جهت‌گیری استراتژیک.`
        : `د ${company.name} د لید او ستراتيژیکې لارښوونې سره مشري.`,
    },
    {
      name: lang === "en" ? "COO Name" : lang === "dari" ? "نام مدیر عملیات" : "د COO نوم",
      role: lang === "en" ? "Chief Operations Officer" : lang === "dari" ? "مدیر عملیات" : "د عملیاتو ریس",
      image: "/images/placeholder.png",
      bio: lang === "en"
        ? "Overseeing daily operations and ensuring operational excellence."
        : lang === "dari"
        ? "نظارت بر عملیات روزمره و تضمین برتری عملیاتی."
        : "د ورځني عملیاتو نظارت او د عملیاتي بریا تضمین.",
    },
    {
      name: lang === "en" ? "CFO Name" : lang === "dari" ? "نام مدیر مالی" : "د CFO نوم",
      role: lang === "en" ? "Chief Financial Officer" : lang === "dari" ? "مدیر مالی" : "د مالي چارو ریس",
      image: "/images/placeholder.png",
      bio: lang === "en"
        ? "Managing financial strategy and fiscal responsibility."
        : lang === "dari"
        ? "مدیریت استراتژی مالی و مسئولیت مالی."
        : "د مالي ستراتيژۍ او مالي مسؤلیت مدیریت.",
    },
    {
      name: lang === "en" ? "CTO Name" : lang === "dari" ? "نام مدیر فنی" : "د CTO نوم",
      role: lang === "en" ? "Chief Technical Officer" : lang === "dari" ? "مدیر فنی" : "د تخنیکي چارو ریس",
      image: "/images/placeholder.png",
      bio: lang === "en"
        ? "Driving innovation and technical advancement."
        : lang === "dari"
        ? "هدایت نوآوری و پیشرفت فنی."
        : "د نوښت او تخنیکي پرمختګ هڅول.",
    },
  ];

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
            {lang === "en" ? "Our Team" : lang === "dari" ? "تیم ما" : "زموږ ټیم"}
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {lang === "en"
              ? "Leadership"
              : lang === "dari"
              ? "رهبری"
              : "مشري"}
          </h2>
        </motion.div>

        <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
          {leaders.map((leader, index) => (
            <motion.div
              key={leader.name}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="group rounded-2xl bg-white/5 border border-white/10 overflow-hidden transition-all hover:-translate-y-2 hover:bg-white/10"
            >
              <div className="relative h-64 overflow-hidden">
                <img
                  src={leader.image}
                  alt={leader.name}
                  className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628] via-transparent to-transparent" />

                <div className="absolute top-4 right-4 flex gap-2 opacity-0 transition-opacity group-hover:opacity-100">
                  {leader.linkedin && (
                    <a
                      href={leader.linkedin}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 backdrop-blur-sm text-white hover:bg-[#C9A227] hover:text-[#0A1628] transition-colors"
                    >
                      {/* <Linkedin size={16} /> */} linkedIn
                    </a>
                  )}
                  {leader.email && (
                    <a
                      href={`mailto:${leader.email}`}
                      className="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 backdrop-blur-sm text-white hover:bg-[#C9A227] hover:text-[#0A1628] transition-colors"
                    >
                      <Mail size={16} />
                    </a>
                  )}
                </div>
              </div>

              <div className="p-6">
                <h3 className="mb-1 text-lg font-bold text-white">{leader.name}</h3>
                <p
                  className="mb-3 text-sm font-medium"
                  style={{ color: company.accent_color }}
                >
                  {leader.role}
                </p>
                <p className="text-white/50 text-sm leading-relaxed">{leader.bio}</p>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}