"use client";

import { useState } from "react";
import { Handshake, ArrowUpRight, Globe } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const globalPartners = [
  {
    name: "UNOPS",
    fullName: "United Nations Office for Project Services",
    type: "Development Partner",
    typeDari: "شریک توسعه",
    logo: "UNOPS",
    projects: 45,
    since: 2008,
    description:
      "Long-term partnership supporting infrastructure development and humanitarian projects across Afghanistan.",
  },
  {
    name: "World Bank",
    fullName: "World Bank Group",
    type: "Financial Partner",
    typeDari: "شریک مالی",
    logo: "WB",
    projects: 32,
    since: 2010,
    description:
      "Collaboration on major road rehabilitation and public infrastructure projects funded by international development grants.",
  },
  {
    name: "USACE",
    fullName: "U.S. Army Corps of Engineers",
    type: "Government Partner",
    typeDari: "شریک دولتی",
    logo: "USACE",
    projects: 28,
    since: 2005,
    description:
      "Strategic partnership for construction and engineering projects supporting stabilization and reconstruction efforts.",
  },
  {
    name: "UNICEF",
    fullName: "United Nations Children's Fund",
    type: "UN Agency",
    typeDari: "سازمان ملل",
    logo: "UNICEF",
    projects: 18,
    since: 2012,
    description:
      "Partnership focused on building schools, health facilities, and water infrastructure for communities in need.",
  },
  {
    name: "Ministry of Public Works",
    fullName: "Islamic Republic of Afghanistan",
    type: "Government",
    typeDari: "دولت",
    logo: "MPW",
    projects: 85,
    since: 2001,
    description:
      "Primary government partner for national highway construction, bridge building, and road maintenance contracts.",
  },
  {
    name: "Ministry of Interior",
    fullName: "Islamic Republic of Afghanistan",
    type: "Government",
    typeDari: "دولت",
    logo: "MOI",
    projects: 42,
    since: 2003,
    description:
      "Collaboration on police headquarters, border facilities, and security infrastructure projects nationwide.",
  },
];

export default function PartnersSection() {
  const { lang } = useI18n();
  const [hoveredPartner, setHoveredPartner] = useState<string | null>(null);

  return (
    <section className="py-24 bg-[#0A1628] relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_#C9A227/5_0%,_transparent_50%)]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="text-center mb-16">
          <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
            <Handshake className="w-4 h-4 inline mr-2" />
            {lang === "en" ? "Global Reach" : lang === "dari" ? "دسترسی جهانی" : "نړیواله رسي"}
          </span>
          <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
            {lang === "en" ? (
              <>
                Global <span className="text-[#C9A227]">Partnerships</span>
              </>
            ) : lang === "dari" ? (
              <>
                مشارکت های <span className="text-[#C9A227]">جهانی</span>
              </>
            ) : (
              <>
                نړیوال <span className="text-[#C9A227]">شریکۍ</span>
              </>
            )}
          </h2>
          <p className="text-white/50 max-w-2xl mx-auto">
            {lang === "en"
              ? "Strategic alliances with international organizations, government agencies, and development partners driving Afghanistan's growth."
              : lang === "dari"
                ? "اتحادهای استراتژیک با سازمان های بین المللی، آژانس های دولتی و شرکای توسعه که رشد افغانستان را هدایت می کنند."
                : "د نړیوالو سازمانونو، دولتي ادارو، او د پراختیا ملګرو سره ستراتیژیکې ټولګټې چې د افغانستان وده هدایت کوي."}
          </p>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {globalPartners.map((partner) => {
            const isHovered = hoveredPartner === partner.name;
            return (
              <div
                key={partner.name}
                onMouseEnter={() => setHoveredPartner(partner.name)}
                onMouseLeave={() => setHoveredPartner(null)}
                className="group relative bg-white/[0.02] border border-white/5 rounded-2xl p-6 hover:bg-white/[0.04] hover:border-[#C9A227]/20 transition-all duration-500"
              >
                <div className="flex items-start justify-between mb-4">
                  <div className="flex items-center gap-3">
                    <div className="w-12 h-12 rounded-xl bg-[#C9A227]/10 border border-[#C9A227]/20 flex items-center justify-center">
                      <span className="text-[#C9A227] font-bold text-sm">{partner.logo}</span>
                    </div>
                    <div>
                      <h3 className="text-white font-bold text-lg">{partner.name}</h3>
                      <p className="text-white/40 text-xs">{partner.fullName}</p>
                    </div>
                  </div>
                  <span className="px-2 py-1 rounded-md bg-white/5 text-white/40 text-xs">
                    {lang === "en" ? partner.type : partner.typeDari}
                  </span>
                </div>

                <div className="flex items-center gap-6 mb-4">
                  <div>
                    <p className="text-[#C9A227] font-bold text-2xl">{partner.projects}</p>
                    <p className="text-white/40 text-xs">
                      {lang === "en" ? "Projects" : lang === "dari" ? "پروژه" : "پروژې"}
                    </p>
                  </div>
                  <div className="w-px h-10 bg-white/10" />
                  <div>
                    <p className="text-white font-bold text-2xl">{partner.since}</p>
                    <p className="text-white/40 text-xs">
                      {lang === "en" ? "Since" : lang === "dari" ? "از" : "له"}
                    </p>
                  </div>
                </div>

                <p className="text-white/50 text-sm leading-relaxed mb-4">{partner.description}</p>

                <div className="flex items-center gap-2 text-[#C9A227]/70 group-hover:text-[#C9A227] text-sm transition-colors">
                  <span>
                    {lang === "en" ? "Learn more" : lang === "dari" ? "بیشتر بدانید" : "نور معلومات"}
                  </span>
                  <ArrowUpRight className="w-4 h-4" />
                </div>
              </div>
            );
          })}
        </div>

        <div className="mt-16 p-8 rounded-2xl bg-[#C9A227]/5 border border-[#C9A227]/10">
          <div className="flex flex-col lg:flex-row items-center justify-between gap-6">
            <div className="flex items-center gap-4">
              <div className="w-16 h-16 rounded-2xl bg-[#C9A227]/10 flex items-center justify-center">
                <Globe className="w-8 h-8 text-[#C9A227]" />
              </div>
              <div>
                <h3 className="text-white font-bold text-xl">
                  {lang === "en"
                    ? "Trusted Worldwide"
                    : lang === "dari"
                      ? "مورد اعتماد در سراسر جهان"
                      : "په نړیواله کچه باوري"}
                </h3>
                <p className="text-white/50 text-sm">
                  {lang === "en"
                    ? "Partnering with leading international organizations for over two decades."
                    : lang === "dari"
                      ? "مشارکت با سازمان های بین المللی برجسته برای بیش از دو دهه."
                      : "له دوو لسیزو زیاته د مخکښو نړیوالو سازمانونو سره شریکي."}
                </p>
              </div>
            </div>
            <div className="flex items-center gap-8">
              <div className="text-center">
                <p className="text-[#C9A227] font-bold text-3xl">250+</p>
                <p className="text-white/40 text-xs">
                  {lang === "en" ? "Joint Projects" : lang === "dari" ? "پروژه مشترک" : "مشترکې پروژې"}
                </p>
              </div>
              <div className="text-center">
                <p className="text-[#C9A227] font-bold text-3xl">$500M+</p>
                <p className="text-white/40 text-xs">
                  {lang === "en" ? "Contract Value" : lang === "dari" ? "ارزش قرارداد" : "د قرارداد ارزښت"}
                </p>
              </div>
              <div className="text-center">
                <p className="text-[#C9A227] font-bold text-3xl">15+</p>
                <p className="text-white/40 text-xs">
                  {lang === "en" ? "Countries" : lang === "dari" ? "کشور" : "هیوادونه"}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}