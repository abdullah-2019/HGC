"use client";

import Link from "next/link";
import Image from "next/image";
import { Award, TrendingUp, ArrowRight, MapPin, Calendar, Users } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { motion, Variants } from "framer-motion";

const images = {
  construction: "https://kimi-web-img.moonshot.cn/img/as1.ftcdn.net/ec2b40ca19e5b77d845ebae48716daf3bdde10f8.jpg",
  mining: "https://kimi-web-img.moonshot.cn/img/www.afghanistan-analysts.org/a96dcbba325966c1459577e281dfdb1ec1fd50e7.jpg",
  road: "https://kimi-web-img.moonshot.cn/img/www.globaltimes.cn/39bf503c47a5d1ec465af024244ec218da04564c.jpeg",
  logistics: "https://kimi-web-img.moonshot.cn/img/images.csmonitor.com/c675c718135a22cf4ead7cb3c7a52983dea8b729.jpg",
};

const fadeInUp: Variants = {
  hidden: { opacity: 0, y: 40 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.7, ease: [0.22, 1, 0.36, 1] as const },
  },
};

const scaleIn: Variants = {
  hidden: { opacity: 0, scale: 0.9 },
  visible: {
    opacity: 1,
    scale: 1,
    transition: { duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
  },
};

const staggerContainer: Variants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: {
      staggerChildren: 0.15,
      delayChildren: 0.1,
    },
  },
};

const staggerItem: Variants = {
  hidden: { opacity: 0, y: 30 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
  },
};

const imageStagger: Variants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: {
      staggerChildren: 0.1,
      delayChildren: 0.3,
    },
  },
};

const imageScale: Variants = {
  hidden: { opacity: 0, scale: 0.9 },
  visible: {
    opacity: 1,
    scale: 1,
    transition: { duration: 0.6, ease: [0.22, 1, 0.36, 1] as const },
  },
};

export default function AboutSection() {
  const { lang } = useI18n();

  return (
    <section className="py-28 bg-[#0A1628] relative overflow-hidden">
      {/* Animated background blobs */}
      <div className="absolute top-20 right-0 w-[500px] h-[500px] bg-[#C9A227]/[0.03] rounded-full blur-[100px] animate-pulse" />
      <div className="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#1A237E]/[0.05] rounded-full blur-[100px]" />
      
      {/* Subtle grid pattern */}
      <div 
        className="absolute inset-0 opacity-[0.02]"
        style={{ 
          backgroundImage: 'linear-gradient(rgba(201,162,39,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(201,162,39,0.3) 1px, transparent 1px)',
          backgroundSize: '60px 60px'
        }}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
          
          {/* Text Content - Left Side */}
          <div className="lg:col-span-5 order-2 lg:order-1">
            <motion.div
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: "-100px" }}
              variants={staggerContainer}
              className="space-y-6"
            >
              {/* Badge */}
              <motion.div 
                variants={staggerItem}
                className="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 text-[#C9A227] text-sm font-semibold backdrop-blur-sm"
              >
                <Award className="w-4 h-4" />
                {lang === "en" ? "About HGC" : lang === "dari" ? "درباره گروپ حافظ" : "د حافظ ګروپ په اړه"}
              </motion.div>

              {/* Heading */}
              <motion.h2 
                variants={staggerItem}
                className="text-4xl lg:text-[3.25rem] font-bold text-white leading-[1.15] tracking-tight"
              >
                {lang === "en" ? (
                  <>
                    Leading Afghan Conglomerate Since <span className="text-[#C9A227] relative inline-block">
                      2001
                      <svg className="absolute -bottom-2 left-0 w-full" viewBox="0 0 100 12" fill="none">
                        <path d="M2 8C20 2 50 2 98 8" stroke="#C9A227" strokeWidth="3" strokeLinecap="round" opacity="0.4"/>
                      </svg>
                    </span>
                  </>
                ) : lang === "dari" ? (
                  <>
                    گروپ پیشرو افغان از سال <span className="text-[#C9A227] relative inline-block">
                      ۲۰۰۱
                      <svg className="absolute -bottom-2 left-0 w-full" viewBox="0 0 100 12" fill="none">
                        <path d="M2 8C20 2 50 2 98 8" stroke="#C9A227" strokeWidth="3" strokeLinecap="round" opacity="0.4"/>
                      </svg>
                    </span>
                  </>
                ) : (
                  <>
                    مخکښ افغان ګروپ له <span className="text-[#C9A227] relative inline-block">
                      ۲۰۰۱
                      <svg className="absolute -bottom-2 left-0 w-full" viewBox="0 0 100 12" fill="none">
                        <path d="M2 8C20 2 50 2 98 8" stroke="#C9A227" strokeWidth="3" strokeLinecap="round" opacity="0.4"/>
                      </svg>
                    </span> کال راهیسې
                  </>
                )}
              </motion.h2>

              {/* Description */}
              <motion.div variants={staggerItem} className="space-y-4">
                <p className="text-white/50 text-lg leading-relaxed">
                  {lang === "en"
                    ? "Hafez Group of Companies is a leading Afghan conglomerate operating in construction, mining, logistics, and financial services. With over 200 completed projects across 38+ provinces, we are transforming Afghanistan's infrastructure landscape."
                    : lang === "dari"
                      ? "گروپ کمپنی های حافظ یک گروپ پیشرو افغان است که در ساختمان، استخراج معادن، لوژستیک و خدمات مالی فعالیت می کند. با بیش از ۲۰۰ پروژه تکمیل شده در ۳۸+ ولایت، ما چشم انداز زیرساخت های افغانستان را تغییر می دهیم."
                      : "د حافظ شرکتونو ګروپ یو مخکښ افغان ګروپ دی چې په جوړولو، د کانونو استخراج، لوجستیک او مالي خدماتو کې فعالیت کوي. په ۳۸+ ولایتونو کې د ۲۰۰+ بشپړو شویو پروژو سره، موږ د افغانستان د زیربنا منظره بدلوو."}
                </p>
                <p className="text-white/40 leading-relaxed">
                  {lang === "en"
                    ? "Our group comprises six specialized companies, each bringing unique expertise to deliver comprehensive solutions for government agencies, international organizations, and private sector clients."
                    : lang === "dari"
                      ? "گروپ ما شامل شش شرکت تخصصی است که هر کدام تخصص منحصر به فردی را برای ارائه راه حل های جامع به سازمان های دولتی، سازمان های بین المللی و مشتریان بخش خصوصی به ارمغان می آورند."
                      : "زموږ ګروپ شپږ تخصصي شرکتونه لري، هر یو یې د دولتي ادارو، نړیوالو سازمانونو او خصوصي سکتور پیرودونکو ته جامع حلونه وړاندې کولو لپاره ځانګړې مهارت راوړي."}
                </p>
              </motion.div>

              {/* Mini Stats Row */}
              <motion.div 
                variants={staggerItem}
                className="flex flex-wrap gap-6 pt-2"
              >
                {[
                  { icon: MapPin, label: lang === "en" ? "38+ Provinces" : lang === "dari" ? "۳۸+ ولایت" : "۳۸+ ولایت", color: "text-emerald-400" },
                  { icon: Calendar, label: lang === "en" ? "Since 2001" : lang === "dari" ? "از ۲۰۰۱" : "له ۲۰۰۱", color: "text-blue-400" },
                  { icon: Users, label: lang === "en" ? "6 Companies" : lang === "dari" ? "۶ شرکت" : "۶ شرکتونه", color: "text-amber-400" },
                ].map((stat, idx) => (
                  <div key={idx} className="flex items-center gap-2.5">
                    <div className="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center border border-white/10">
                      <stat.icon className={`w-4 h-4 ${stat.color}`} />
                    </div>
                    <span className="text-white/70 text-sm font-medium">{stat.label}</span>
                  </div>
                ))}
              </motion.div>

              {/* CTA */}
              <motion.div variants={staggerItem} className="pt-4">
                <Link
                  href="/about"
                  className="group inline-flex items-center gap-3 bg-[#C9A227] text-[#0A1628] px-7 py-3.5 rounded-xl font-bold text-sm hover:bg-[#D4AF37] transition-all duration-300 shadow-lg shadow-[#C9A227]/20 hover:shadow-[#C9A227]/30 hover:-translate-y-0.5"
                >
                  {lang === "en" ? "Explore Our Story" : lang === "dari" ? "داستان ما را کشف کنید" : "زموږ کیسه وګورئ"}
                  <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" />
                </Link>
              </motion.div>
            </motion.div>
          </div>

          {/* Image Mosaic - Right Side */}
          <div className="lg:col-span-7 order-1 lg:order-2 relative">
            <motion.div
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: "-50px" }}
              variants={imageStagger}
              className="relative"
            >
              {/* Main large image */}
              <motion.div 
                variants={imageScale}
                className="relative aspect-[16/10] rounded-3xl overflow-hidden shadow-2xl shadow-black/50 group"
              >
                <Image
                  src={images.construction}
                  alt="Construction"
                  fill
                  className="object-cover transition-transform duration-1000 group-hover:scale-105"
                  sizes="(max-width: 1024px) 100vw, 60vw"
                  priority
                />
                {/* Cinematic overlay */}
                <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628] via-[#0A1628]/20 to-transparent opacity-60" />
                <div className="absolute inset-0 bg-gradient-to-r from-[#0A1628]/40 to-transparent" />
                
                {/* Floating label */}
                <div className="absolute bottom-6 left-6 right-6">
                  <div className="flex items-end justify-between">
                    <div>
                      <span className="inline-block px-3 py-1 rounded-full bg-[#C9A227]/20 border border-[#C9A227]/30 text-[#C9A227] text-xs font-bold uppercase tracking-widest mb-2 backdrop-blur-md">
                        Construction
                      </span>
                      <h3 className="text-white text-xl font-bold">
                        {lang === "en" ? "Building the Future" : lang === "dari" ? "ساختن آینده" : "راتلونکی جوړول"}
                      </h3>
                    </div>
                  </div>
                </div>
              </motion.div>

              {/* Secondary images grid */}
              <div className="grid grid-cols-3 gap-3 mt-3">
                {[
                  { src: images.mining, label: "Mining", sublabel: lang === "en" ? "Extracting Value" : lang === "dari" ? "استخراج ارزش" : "ارزښت استخراج" },
                  { src: images.road, label: "Infrastructure", sublabel: lang === "en" ? "Connecting Nations" : lang === "dari" ? "اتصال ملت ها" : "ملتونه سره نښلوي" },
                  { src: images.logistics, label: "Logistics", sublabel: lang === "en" ? "Moving Forward" : lang === "dari" ? "حرکت به جلو" : "مخته حرکت" },
                ].map((img, i) => (
                  <motion.div
                    key={i}
                    variants={imageScale}
                    className="relative aspect-[4/3] rounded-2xl overflow-hidden group cursor-pointer"
                  >
                    <Image
                      src={img.src}
                      alt={img.label}
                      fill
                      className="object-cover transition-transform duration-700 group-hover:scale-110"
                      sizes="(max-width: 1024px) 33vw, 20vw"
                    />
                    <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors duration-500" />
                    <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628]/90 via-transparent to-transparent" />
                    
                    <div className="absolute bottom-3 left-3 right-3 translate-y-2 opacity-80 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                      <span className="text-[#C9A227] text-[10px] font-bold uppercase tracking-wider">{img.label}</span>
                      <p className="text-white text-xs font-medium mt-0.5 leading-tight">{img.sublabel}</p>
                    </div>
                  </motion.div>
                ))}
              </div>

              {/* Floating Stats Card */}
              <motion.div 
                variants={imageScale}
                className="absolute -bottom-4 -left-4 lg:-left-12 bg-[#0F1D32]/95 backdrop-blur-xl border border-[#C9A227]/20 rounded-2xl p-5 shadow-2xl shadow-black/40 z-10"
              >
                <div className="flex items-center gap-4">
                  <div className="w-14 h-14 rounded-xl bg-[#C9A227]/10 flex items-center justify-center border border-[#C9A227]/20 relative overflow-hidden">
                    <div className="absolute inset-0 bg-[#C9A227]/5 animate-pulse" />
                    <TrendingUp className="w-7 h-7 text-[#C9A227] relative z-10" />
                  </div>
                  <div>
                    <p className="text-white font-bold text-2xl tracking-tight">200+</p>
                    <p className="text-white/40 text-xs font-medium uppercase tracking-wider">
                      {lang === "en" ? "Projects Completed" : lang === "dari" ? "پروژه تکمیل شده" : "بشپړې شوې پروژې"}
                    </p>
                  </div>
                </div>
                {/* Mini progress bar */}
                <div className="mt-3 h-1 bg-white/10 rounded-full overflow-hidden">
                  <div className="h-full w-[85%] bg-[#C9A227] rounded-full" />
                </div>
              </motion.div>

              {/* Decorative elements */}
              <div className="absolute -top-6 -right-6 w-32 h-32 border border-[#C9A227]/10 rounded-full" />
              <div className="absolute -top-6 -right-6 w-24 h-24 border border-[#C9A227]/20 rounded-full" />
              <div className="absolute -bottom-8 right-12 w-2 h-2 bg-[#C9A227] rounded-full animate-ping" />
              <div className="absolute top-1/2 -right-3 w-1.5 h-16 bg-[#C9A227]/20 rounded-full" />
            </motion.div>
          </div>
        </div>
      </div>
    </section>
  );
}