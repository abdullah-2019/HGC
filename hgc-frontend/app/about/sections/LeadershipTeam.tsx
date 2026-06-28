"use client";

import Image from "next/image";
import { useState } from "react";
// import { LinkedinIcon, Mail, Quote } from "lucide-react";
import {  Mail, Quote } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import ScrollReveal from "@/app/about/components/ScrollReveal";

const leaders = [
  {
    name: "Haji Mohammad Hafez",
    roleEn: "Founder & Chairman",
    roleDari: "بنیانگذار و رئیس هیئت مدیره",
    image: "/images/placeholder.png",
    quoteEn: "Building Afghanistan is not just our business — it is our duty and our honor.",
    quoteDari: "ساختن افغانستان فقط تجارت ما نیست — این وظیفه و افتخار ماست.",
    // linkedin: "#",
    email: "chairman@hgc.af",
  },
  {
    name: "Eng. Ahmad Shah Hafez",
    roleEn: "CEO & Managing Director",
    roleDari: "مدیرعامل و مدیر اجرایی",
    image: "/images/placeholder.png",
    quoteEn: "Quality infrastructure is the foundation upon which nations rise.",
    quoteDari: "زیرساخت با کیفیت بنیادی است که ملت ها بر آن برمی خیزند.",
    linkedin: "#",
    email: "ceo@hgc.af",
  },
  {
    name: "Dr. Fatima Noori",
    roleEn: "Chief Operations Officer",
    roleDari: "مدیر عملیات",
    image: "/images/placeholder.png",
    quoteEn: "Operational excellence is not a goal — it is a continuous journey.",
    quoteDari: "برتری عملیاتی یک هدف نیست — این یک سفر مداوم است.",
    linkedin: "#",
    email: "coo@hgc.af",
  },
];

export default function LeadershipTeam() {
  const { lang } = useI18n();
  const [hoveredIdx, setHoveredIdx] = useState<number | null>(null);

  return (
    <section className="about-section py-24 lg:py-32 bg-[#0A1628]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ScrollReveal className="text-center mb-20">
          <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 text-[#C9A227] text-sm font-medium mb-6">
            {lang === "en" ? "Leadership" : lang === "dari" ? "رهبری" : "مشري"}
          </span>
          <h2 className="about-section-title font-bold text-white mb-6">
            {lang === "en" ? (
              <>Meet Our <span className="text-gold-gradient">Leadership</span></>
            ) : lang === "dari" ? (
              <>با <span className="text-gold-gradient">رهبری</span> ما آشنا شوید</>
            ) : (
              <>زموږ <span className="text-gold-gradient">مشري</span> وګورئ</>
            )}
          </h2>
          <p className="about-body-text text-white/50 max-w-2xl mx-auto">
            {lang === "en"
              ? "Visionaries who have guided HGC from a single construction firm to a national conglomerate."
              : lang === "dari"
                ? "رویادانانی که گروپ حافظ را از یک شرکت ساختمانی واحد به یک گروپ ملی هدایت کرده‌اند."
                : "هغه لیدونکي چې HGC یې له یوې واحدې جوړونې شرکت څخه تر یو ملي ګروپ پورې لارښوونه کړې ده."}
          </p>
        </ScrollReveal>

        <div className="grid md:grid-cols-3 gap-8">
          {leaders.map((leader, idx) => {
            const isHovered = hoveredIdx === idx;
            return (
              <ScrollReveal key={idx} delay={idx * 0.15}>
                <div
                  onMouseEnter={() => setHoveredIdx(idx)}
                  onMouseLeave={() => setHoveredIdx(null)}
                  className="group relative"
                >
                  <div className="glass-card rounded-2xl overflow-hidden">
                    <div className="relative aspect-[3/4] overflow-hidden">
                      <Image
                        src={leader.image}
                        alt={leader.name}
                        fill
                        className="object-cover img-zoom"
                        sizes="(max-width: 768px) 100vw, 33vw"
                      />
                      <div className="team-overlay absolute inset-0" />
                      
                      <div
                        className="absolute inset-0 bg-[#0A1628]/85 flex items-center justify-center p-6 transition-opacity duration-500"
                        style={{ opacity: isHovered ? 1 : 0 }}
                      >
                        <div className="text-center">
                          <Quote className="w-8 h-8 text-[#C9A227] mx-auto mb-4" />
                          <p className="text-white/90 text-sm leading-relaxed italic">
                            &ldquo;{lang === "en" ? leader.quoteEn : leader.quoteDari}&rdquo;
                          </p>
                        </div>
                      </div>
                    </div>

                    <div className="relative p-6 -mt-16">
                      <h3 className="text-xl font-bold text-white mb-1">{leader.name}</h3>
                      <p className="text-[#C9A227] text-sm mb-4">
                        {lang === "en" ? leader.roleEn : leader.roleDari}
                      </p>
                      <div className="flex items-center gap-3">
                        <a href={leader.linkedin} className="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center text-white/40 hover:bg-[#C9A227]/10 hover:text-[#C9A227] transition-all">
                          {/* <LinkedinIcon className="w-4 h-4" /> */}
                        </a>
                        <a href={`mailto:${leader.email}`} className="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center text-white/40 hover:bg-[#C9A227]/10 hover:text-[#C9A227] transition-all">
                          <Mail className="w-4 h-4" />
                        </a>
                      </div>
                    </div>
                  </div>
                  <div className="absolute -bottom-2 -right-2 w-16 h-16 border-b-2 border-r-2 border-[#C9A227]/0 group-hover:border-[#C9A227]/30 rounded-br-2xl transition-all duration-500" />
                </div>
              </ScrollReveal>
            );
          })}
        </div>
      </div>
    </section>
  );
}