"use client";

import { Award, MapPin, Shield, Users } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const whyChoose = [
  {
    icon: Award,
    title: "24+ Years Experience",
    titleDari: "۲۴+ سال تجربه",
    desc: "Over two decades of delivering excellence in construction and infrastructure across Afghanistan.",
    descDari: "بیش از دو دهه ارائه excellence در ساخت و زیرساخت در سراسر افغانستان.",
  },
  {
    icon: MapPin,
    title: "National Coverage",
    titleDari: "پوشش ملی",
    desc: "Active operations in 38+ provinces with deep local knowledge and expertise.",
    descDari: "عملیات فعال در بیش از ۳۸ ولایت با دانش و تخصص محلی عمیق.",
  },
  {
    icon: Shield,
    title: "Quality Standards",
    titleDari: "استانداردهای کیفی",
    desc: "ISO-certified processes and international best practices in every project.",
    descDari: "فرآیندهای دارای گواهی ISO و بهترین شیوه های بین المللی در هر پروژه.",
  },
  {
    icon: Users,
    title: "Local Employment",
    titleDari: "اشتغال محلی",
    desc: "Creating thousands of jobs and building capacity in Afghan workforce.",
    descDari: "ایجاد هزاران شغل و ایجاد ظرفیت در نیروی کار افغان.",
  },
];

export default function WhyChooseSection() {
  const { lang } = useI18n();

  return (
    <section className="py-24 bg-[#0A1628] relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,_#C9A227/5_0%,_transparent_50%)]" />
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="text-center mb-16">
          <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
            {lang === "en" ? "Why Us" : lang === "dari" ? "چرا ما" : "ولې موږ"}
          </span>
          <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
            {lang === "en" ? (
              <>
                Why Choose <span className="text-[#C9A227]">HGC</span>
              </>
            ) : lang === "dari" ? (
              <>
                چرا <span className="text-[#C9A227]">گروپ حافظ</span> را انتخاب کنیم
              </>
            ) : (
              <>
                ولې <span className="text-[#C9A227]">حافظ ګروپ</span> غوره کړئ
              </>
            )}
          </h2>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          {whyChoose.map((item, idx) => {
            const Icon = item.icon;
            return (
              <div
                key={idx}
                className="group relative bg-white/[0.02] border border-white/5 rounded-2xl p-8 hover:bg-white/[0.04] hover:border-[#C9A227]/20 transition-all duration-500"
              >
                <div className="w-16 h-16 rounded-2xl bg-[#C9A227]/10 flex items-center justify-center mb-6 group-hover:bg-[#C9A227]/20 group-hover:scale-110 transition-all duration-500">
                  <Icon className="w-8 h-8 text-[#C9A227]" />
                </div>
                <h3 className="text-white font-bold text-xl mb-3">
                  {lang === "en" ? item.title : item.titleDari}
                </h3>
                <p className="text-white/50 text-sm leading-relaxed">
                  {lang === "en" ? item.desc : item.descDari}
                </p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}