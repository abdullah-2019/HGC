"use client";

import { useState, useEffect } from "react";
import { Quote, Users } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";

const testimonials = [
  {
    text: "Hafez Construction delivered our highway project on time and exceeded quality expectations. Their professionalism is unmatched in Afghanistan.",
    textDari:
      "شرکت ساختمانی حافظ پروژه سرک ما را به موقع تحویل داد و انتظارات کیفی را فراتر برد. حرفه ای بودن آنها در افغانستان بی نظیر است.",
    author: "Eng. Ahmad Shah",
    authorDari: "انجینر احمد شاه",
    role: "Ministry of Public Works",
    roleDari: "وزارت فواید عامه",
  },
  {
    text: "Working with HGC on the Badakhshan police headquarters was a seamless experience. Their attention to detail and safety standards are exemplary.",
    textDari:
      "کار با گروپ حافظ در ساختمان قومندانی امنیه بدخشان یک تجربه روان بود. توجه آنها به جزئیات و استانداردهای ایمنی نمونه است.",
    author: "Col. Mohammad Khan",
    authorDari: "سرهنگ محمد خان",
    role: "Ministry of Interior",
    roleDari: "وزارت داخله",
  },
  {
    text: "The solar installation for Nangarhar customs was completed efficiently. HGC's technical expertise in renewable energy is impressive.",
    textDari:
      "نصب برق خورشیدی برای گمرک ننگرهار به طور کارآمد تکمیل شد. تخصص فنی گروپ حافظ در انرژی تجدیدپذیر قابل توجه است.",
    author: "Dr. Fatima Noori",
    authorDari: "داکتر فاطمه نوری",
    role: "Ministry of Finance",
    roleDari: "وزارت مالیه",
  },
];

export default function TestimonialsSection() {
  const { lang } = useI18n();
  const [activeTestimonial, setActiveTestimonial] = useState(0);

  useEffect(() => {
    const timer = setInterval(() => {
      setActiveTestimonial((prev) => (prev + 1) % testimonials.length);
    }, 6000);
    return () => clearInterval(timer);
  }, []);

  return (
    <section className="py-24 bg-[#0A1628] relative">
      <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
            {lang === "en" ? "Testimonials" : lang === "dari" ? "نظرات" : "څرګندونې"}
          </span>
          <h2 className="text-4xl lg:text-5xl font-bold text-white">
            {lang === "en" ? (
              <>
                What Our <span className="text-[#C9A227]">Clients Say</span>
              </>
            ) : lang === "dari" ? (
              <>
                مشتریان ما <span className="text-[#C9A227]">چه می گویند</span>
              </>
            ) : (
              <>
                زموږ <span className="text-[#C9A227]">پیرودونکي څه وايي</span>
              </>
            )}
          </h2>
        </div>

        <div className="relative">
          <div className="bg-white/[0.02] border border-white/5 rounded-3xl p-8 lg:p-12 relative">
            <Quote className="absolute top-8 left-8 w-12 h-12 text-[#C9A227]/10" />
            <div className="relative z-10">
              <p className="text-white/80 text-lg lg:text-xl leading-relaxed mb-8 text-center italic">
                &ldquo;
                {lang === "en"
                  ? testimonials[activeTestimonial].text
                  : testimonials[activeTestimonial].textDari}
                &rdquo;
              </p>
              <div className="flex items-center justify-center gap-4">
                <div className="w-14 h-14 rounded-full bg-[#C9A227]/10 border-2 border-[#C9A227]/20 flex items-center justify-center">
                  <Users className="w-6 h-6 text-[#C9A227]" />
                </div>
                <div className="text-center">
                  <p className="text-white font-bold">
                    {lang === "en"
                      ? testimonials[activeTestimonial].author
                      : testimonials[activeTestimonial].authorDari}
                  </p>
                  <p className="text-white/50 text-sm">
                    {lang === "en"
                      ? testimonials[activeTestimonial].role
                      : testimonials[activeTestimonial].roleDari}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div className="flex items-center justify-center gap-3 mt-8">
            {testimonials.map((_, idx) => (
              <button
                key={idx}
                onClick={() => setActiveTestimonial(idx)}
                className={`transition-all duration-300 rounded-full ${
                  activeTestimonial === idx
                    ? "w-8 h-2 bg-[#C9A227]"
                    : "w-2 h-2 bg-white/20 hover:bg-white/40"
                }`}
              />
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}