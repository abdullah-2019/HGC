// "use client";

// import React, { useState, useEffect, useRef } from "react";
// import Link from "next/link";
// import Image from "next/image";
// import {
//   ArrowRight, ChevronRight, Building2, Mountain, HardHat, Store, Landmark, Truck,
//   Phone, Mail, MapPin, Calendar, DollarSign, CheckCircle2, Users, Award, Shield,
//   TrendingUp, Star, Clock, Briefcase, Hammer, Zap, Sun, Home, Road, Globe,
//   Handshake, Target, Package, Container, ArrowUpRight, ChevronLeft, ExternalLink,
//   Pickaxe, Wrench, Cpu, Battery, Cable, Factory, Gem, Fuel, Anchor, Boxes,
//   MoveRight, Quote
// } from "lucide-react";
// import { useI18n } from "@/components/useI18nStore";
// import { t } from "@/components/translations";

// /* ───────────────────────────────────────────────
//    HGC HOMEPAGE V2 — Enhanced with Products & Partners
//    Inspired by mezansultanigroup.com
//    ─────────────────────────────────────────────── */

// function useCountUp(end: number, duration: number = 2000) {
//   const [count, setCount] = useState(0);
//   const [isVisible, setIsVisible] = useState(false);
//   const ref = useRef<HTMLDivElement>(null);

//   useEffect(() => {
//     const observer = new IntersectionObserver(
//       ([entry]) => { if (entry.isIntersecting) setIsVisible(true); },
//       { threshold: 0.3 }
//     );
//     if (ref.current) observer.observe(ref.current);
//     return () => observer.disconnect();
//   }, []);

//   useEffect(() => {
//     if (!isVisible) return;
//     let start = 0;
//     const increment = end / (duration / 16);
//     const timer = setInterval(() => {
//       start += increment;
//       if (start >= end) { setCount(end); clearInterval(timer); }
//       else { setCount(Math.floor(start)); }
//     }, 16);
//     return () => clearInterval(timer);
//   }, [isVisible, end, duration]);

//   return { count, ref };
// }

// const stats = [
//   { value: 24, suffix: "+", labelKey: "common.yearsExperience", icon: Clock },
//   { value: 200, suffix: "+", labelKey: "common.projectsCompleted", icon: Briefcase },
//   { value: 38, suffix: "+", labelKey: "common.provincesCovered", icon: MapPin },
//   { value: 6, suffix: "", labelKey: "common.companiesInGroup", icon: Building2 },
// ];

// const companies = [
//   { slug: "hcrc", accent: "#B22222", icon: Building2 },
//   { slug: "albahrain", accent: "#1A237E", icon: Mountain },
//   { slug: "zainnoorain", accent: "#F57C00", icon: HardHat },
//   { slug: "almadinah", accent: "#2E7D32", icon: Store },
//   { slug: "haramain", accent: "#FFD700", icon: Landmark },
//   { slug: "alkoozi", accent: "#00838F", icon: Truck },
// ];

// const featuredProducts = [
//   {
//     id: 1, name: "Crushed Stone Aggregate", nameDari: "سنگدانه خرد شده", namePashto: "مات شوي ډبرې",
//     category: "Mining", categoryDari: "استخراج معادن", icon: Pickaxe,
//     description: "High-quality crushed stone for construction and road building, sourced from our own quarries.",
//     descriptionDari: "سنگ خرد شده با کیفیت بالا برای ساخت و ساز و ساخت سرک، از معادن خود ما.",
//     specs: ["Various sizes: 0-5mm, 5-10mm, 10-20mm", "High compressive strength", "Available in bulk quantities"],
//   },
//   {
//     id: 2, name: "Ready-Mix Concrete", nameDari: "بتن آماده", namePashto: "چمتو شوی کنکریټ",
//     category: "Construction", categoryDari: "ساختمان", icon: Wrench,
//     description: "Premium ready-mix concrete delivered to your site with consistent quality and timely supply.",
//     descriptionDari: "بتن آماده با کیفیت بالا به سایت شما تحویل داده می شود با کیفیت ثابت و تدارک به موقع.",
//     specs: ["Grade M15 to M50", "On-site pumping available", "24/7 batching plant operation"],
//   },
//   {
//     id: 3, name: "Bitumen & Asphalt", nameDari: "قیر و آسفالت", namePashto: "بیټومین او اسفالټ",
//     category: "Roads", categoryDari: "سرک", icon: Road,
//     description: "Industrial-grade bitumen and asphalt products for highway and road surfacing projects.",
//     descriptionDari: "محصولات قیر و آسفالت درجه صنعتی برای پروژه های سطح سرک و بزرگراه.",
//     specs: ["Penetration grades: 60/70, 80/100", "Cutback and emulsion types", "Bulk and drum packaging"],
//   },
//   {
//     id: 4, name: "Solar Power Systems", nameDari: "سیستم های برق خورشیدی", namePashto: "د سولري برق سیسټمونه",
//     category: "Energy", categoryDari: "انرژی", icon: Sun,
//     description: "Complete solar power solutions from 5kW to 500kW for residential, commercial, and industrial use.",
//     descriptionDari: "راه حل های کامل برق خورشیدی از ۵ کیلووات تا ۵۰۰ کیلووات برای استفاده مسکونی، تجاری و صنعتی.",
//     specs: ["Tier-1 solar panels", "MPPT charge controllers", "Lithium battery storage"],
//   },
//   {
//     id: 5, name: "Construction Equipment Rental", nameDari: "اجاره تجهیزات ساختمانی", namePashto: "د جوړونې تجهیزات کرایه",
//     category: "Equipment", categoryDari: "تجهیزات", icon: Hammer,
//     description: "Modern construction machinery and equipment rental with trained operators and maintenance support.",
//     descriptionDari: "اجاره ماشین آلات و تجهیزات ساختمانی مدرن با اپراتورهای آموزش دیده و پشتیبانی نگهداری.",
//     specs: ["Excavators, bulldozers, cranes", "Dump trucks and loaders", "Concrete mixers and pumps"],
//   },
//   {
//     id: 6, name: "Logistics & Freight Services", nameDari: "خدمات لوژستیک و باربری", namePashto: "لوجستیکي او بار وړلو خدمات",
//     category: "Logistics", categoryDari: "لوژستیک", icon: Container,
//     description: "End-to-end logistics solutions including warehousing, transportation, and customs clearance across Afghanistan.",
//     descriptionDari: "راه حل های لوژستیک end-to-end شامل انبارداری، حمل و نقل و ترخیص گمرکی در سراسر افغانستان.",
//     specs: ["Nationwide fleet network", "Cold chain logistics", "Real-time tracking"],
//   },
// ];

// const globalPartners = [
//   {
//     name: "UNOPS", fullName: "United Nations Office for Project Services", type: "Development Partner", typeDari: "شریک توسعه",
//     logo: "UNOPS", projects: 45, since: 2008,
//     description: "Long-term partnership supporting infrastructure development and humanitarian projects across Afghanistan.",
//   },
//   {
//     name: "World Bank", fullName: "World Bank Group", type: "Financial Partner", typeDari: "شریک مالی",
//     logo: "WB", projects: 32, since: 2010,
//     description: "Collaboration on major road rehabilitation and public infrastructure projects funded by international development grants.",
//   },
//   {
//     name: "USACE", fullName: "U.S. Army Corps of Engineers", type: "Government Partner", typeDari: "شریک دولتی",
//     logo: "USACE", projects: 28, since: 2005,
//     description: "Strategic partnership for construction and engineering projects supporting stabilization and reconstruction efforts.",
//   },
//   {
//     name: "UNICEF", fullName: "United Nations Children's Fund", type: "UN Agency", typeDari: "سازمان ملل",
//     logo: "UNICEF", projects: 18, since: 2012,
//     description: "Partnership focused on building schools, health facilities, and water infrastructure for communities in need.",
//   },
//   {
//     name: "Ministry of Public Works", fullName: "Islamic Republic of Afghanistan", type: "Government", typeDari: "دولت",
//     logo: "MPW", projects: 85, since: 2001,
//     description: "Primary government partner for national highway construction, bridge building, and road maintenance contracts.",
//   },
//   {
//     name: "Ministry of Interior", fullName: "Islamic Republic of Afghanistan", type: "Government", typeDari: "دولت",
//     logo: "MOI", projects: 42, since: 2003,
//     description: "Collaboration on police headquarters, border facilities, and security infrastructure projects nationwide.",
//   },
// ];

// const featuredProjects = [
//   {
//     id: 1, title: "Kabul-Kandahar Highway Rehabilitation", titleDari: "ترمیم اساس سرک کابل - کندهار",
//     location: "Kandahar", locationDari: "کندهار", client: "Ministry of Public Works", clientDari: "وزارت فواید عامه",
//     budget: "558,378,156 AFN", duration: "2023 - 2025", status: "completed", category: "roads",
//     description: "37km highway rehabilitation from Shah Safa to Manji on the Kabul-Kandahar National Highway.",
//   },
//   {
//     id: 2, title: "Badakhshan Police HQ & Hospital", titleDari: "قومندانی امنیه و شفاخانه پولیس بدخشان",
//     location: "Badakhshan", locationDari: "بدخشان", client: "Ministry of Interior", clientDari: "وزارت داخله",
//     budget: "6,198,630 AFN", duration: "2023", status: "completed", category: "buildings",
//     description: "Construction of special police headquarters and 20-bed hospital in Badakhshan province.",
//   },
//   {
//     id: 3, title: "Nangarhar Solar Power System", titleDari: "سیستم برق سولری ننگرهار",
//     location: "Nangarhar", locationDari: "ننگرهار", client: "Ministry of Finance", clientDari: "وزارت مالیه",
//     budget: "5,165,990 AFN", duration: "2023 - 2024", status: "completed", category: "solar",
//     description: "Supply and installation of 150kW DC solar power system for Nangarhar Customs.",
//   },
//   {
//     id: 4, title: "Kharwar District Administrative Building", titleDari: "ساختمان اداری ولسوالی خروار",
//     location: "Logar", locationDari: "لوگر", client: "Ministry of Interior", clientDari: "وزارت داخله",
//     budget: "20,000,000 AFN", duration: "2024 - 2025", status: "ongoing", category: "buildings",
//     description: "Construction of administrative building for Kharwar district in Logar province.",
//   },
// ];

// const whyChoose = [
//   { icon: Award, title: "24+ Years Experience", titleDari: "۲۴+ سال تجربه",
//     desc: "Over two decades of delivering excellence in construction and infrastructure across Afghanistan.",
//     descDari: "بیش از دو دهه ارائه excellence در ساخت و زیرساخت در سراسر افغانستان." },
//   { icon: MapPin, title: "National Coverage", titleDari: "پوشش ملی",
//     desc: "Active operations in 38+ provinces with deep local knowledge and expertise.",
//     descDari: "عملیات فعال در بیش از ۳۸ ولایت با دانش و تخصص محلی عمیق." },
//   { icon: Shield, title: "Quality Standards", titleDari: "استانداردهای کیفی",
//     desc: "ISO-certified processes and international best practices in every project.",
//     descDari: "فرآیندهای دارای گواهی ISO و بهترین شیوه های بین المللی در هر پروژه." },
//   { icon: Users, title: "Local Employment", titleDari: "اشتغال محلی",
//     desc: "Creating thousands of jobs and building capacity in Afghan workforce.",
//     descDari: "ایجاد هزاران شغل و ایجاد ظرفیت در نیروی کار افغان." },
// ];

// const clients = [
//   { name: "UNOPS", abbr: "UNOPS" }, { name: "UNICEF", abbr: "UNICEF" },
//   { name: "UNFPA", abbr: "UNFPA" }, { name: "USACE", abbr: "USACE" },
//   { name: "Ministry of Interior", abbr: "MOI" }, { name: "Ministry of Public Works", abbr: "MPW" },
//   { name: "World Bank", abbr: "WB" }, { name: "Ministry of Finance", abbr: "MOF" },
// ];

// const testimonials = [
//   {
//     text: "Hafez Construction delivered our highway project on time and exceeded quality expectations. Their professionalism is unmatched in Afghanistan.",
//     textDari: "شرکت ساختمانی حافظ پروژه سرک ما را به موقع تحویل داد و انتظارات کیفی را فراتر برد. حرفه ای بودن آنها در افغانستان بی نظیر است.",
//     author: "Eng. Ahmad Shah", authorDari: "انجینر احمد شاه",
//     role: "Ministry of Public Works", roleDari: "وزارت فواید عامه",
//   },
//   {
//     text: "Working with HGC on the Badakhshan police headquarters was a seamless experience. Their attention to detail and safety standards are exemplary.",
//     textDari: "کار با گروپ حافظ در ساختمان قومندانی امنیه بدخشان یک تجربه روان بود. توجه آنها به جزئیات و استانداردهای ایمنی نمونه است.",
//     author: "Col. Mohammad Khan", authorDari: "سرهنگ محمد خان",
//     role: "Ministry of Interior", roleDari: "وزارت داخله",
//   },
//   {
//     text: "The solar installation for Nangarhar customs was completed efficiently. HGC's technical expertise in renewable energy is impressive.",
//     textDari: "نصب برق خورشیدی برای گمرک ننگرهار به طور کارآمد تکمیل شد. تخصص فنی گروپ حافظ در انرژی تجدیدپذیر قابل توجه است.",
//     author: "Dr. Fatima Noori", authorDari: "داکتر فاطمه نوری",
//     role: "Ministry of Finance", roleDari: "وزارت مالیه",
//   },
// ];

// const sectors = [
//   { name: "Roads", nameDari: "سرک ها", icon: Road, count: 85 },
//   { name: "Buildings", nameDari: "ساختمان ها", icon: Home, count: 62 },
//   { name: "Mining", nameDari: "معادن", icon: Mountain, count: 18 },
//   { name: "Electrical", nameDari: "برق", icon: Zap, count: 24 },
//   { name: "Solar", nameDari: "سولری", icon: Sun, count: 12 },
//   { name: "Logistics", nameDari: "لوژستیک", icon: Truck, count: 30 },
// ];

// export default function HomePage() {
//   const { lang, dir } = useI18n();
//   const [activeProjectFilter, setActiveProjectFilter] = useState("all");
//   const [activeTestimonial, setActiveTestimonial] = useState(0);
//   const [hoveredCompany, setHoveredCompany] = useState<string | null>(null);
//   const [hoveredPartner, setHoveredPartner] = useState<string | null>(null);

//   const filteredProjects = activeProjectFilter === "all"
//     ? featuredProjects
//     : featuredProjects.filter((p) => p.category === activeProjectFilter);

//   const projectFilters = [
//     { key: "all", label: "All", labelDari: "همه" },
//     { key: "roads", label: "Roads", labelDari: "سرک ها" },
//     { key: "buildings", label: "Buildings", labelDari: "ساختمان ها" },
//     { key: "mining", label: "Mining", labelDari: "معادن" },
//     { key: "electrical", label: "Electrical", labelDari: "برق" },
//     { key: "solar", label: "Solar", labelDari: "سولری" },
//   ];

//   useEffect(() => {
//     const timer = setInterval(() => {
//       setActiveTestimonial((prev) => (prev + 1) % testimonials.length);
//     }, 6000);
//     return () => clearInterval(timer);
//   }, []);

//   return (
//     <div dir={dir} className="overflow-hidden">
//       {/* ═══════════════════════════════════════════
//           HERO SECTION
//           ═══════════════════════════════════════════ */}
//       <section className="relative min-h-screen flex items-center justify-center overflow-hidden">
//         <div className="absolute inset-0">
//           <div className="absolute inset-0 bg-[url('/images/hero-construction.jpg')] bg-cover bg-center" />
//           <div className="absolute inset-0 bg-[#0A1628]/85" />
//           <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_transparent_0%,_#0A1628_70%)]" />
//         </div>
//         <div className="absolute inset-0 opacity-10">
//           <div className="absolute inset-0" style={{
//             backgroundImage: `linear-gradient(rgba(201,162,39,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(201,162,39,0.3) 1px, transparent 1px)`,
//             backgroundSize: '60px 60px'
//           }} />
//         </div>
//         <div className="absolute inset-0 overflow-hidden">
//           {[...Array(30)].map((_, i) => (
//             <div key={i} className="absolute w-1 h-1 bg-[#C9A227]/40 rounded-full animate-pulse"
//               style={{ left: `${Math.random() * 100}%`, top: `${Math.random() * 100}%`,
//                 animationDelay: `${Math.random() * 5}s`, animationDuration: `${2 + Math.random() * 4}s` }} />
//           ))}
//         </div>
//         <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
//           <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 mb-8 animate-fade-in">
//             <Star className="w-4 h-4 text-[#C9A227]" />
//             <span className="text-[#C9A227] text-sm font-medium">
//               {lang === "en" ? "Since 2001 — Building Afghanistan's Future"
//                 : lang === "dari" ? "از سال ۲۰۰۱ — ساختن آینده افغانستان"
//                 : "له ۲۰۰۱ کال راهیسې — د افغانستان راتلونکی جوړول"}
//             </span>
//           </div>
//           <h1 className="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-6 leading-tight tracking-tight">
//             {lang === "en" ? (
//               <>Building <span className="text-[#C9A227]">Afghanistan's</span><br />Future</>
//             ) : lang === "dari" ? (
//               <><span className="text-[#C9A227]">آینده</span> افغانستان<br />را می سازیم</>
//             ) : (
//               <>د <span className="text-[#C9A227]">افغانستان</span><br />راتلونکی جوړوو</>
//             )}
//           </h1>
//           <p className="text-xl text-white/60 max-w-3xl mx-auto mb-12 leading-relaxed">
//             {lang === "en" ? "Construction • Mining • Logistics • Financial Services — A diversified conglomerate driving national development across 38+ provinces."
//               : lang === "dari" ? "ساختمان • استخراج معادن • لوژستیک • خدمات مالی — یک گروپ متنوع که توسعه ملی را در بیش از ۳۸ ولایت هدایت می کند."
//               : "ودانۍ • د کانونو استخراج • لوجستیک • مالي خدمات — یو متنوع ګروپ چې په ۳۸+ ولایتونو کې ملي پراختیا رهبري کوي."}
//           </p>
//           <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
//             <Link href="/projects" className="group flex items-center gap-2 px-8 py-4 bg-[#C9A227] text-[#0A1628] font-bold rounded-xl hover:bg-[#C9A227]/90 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#C9A227]/20">
//               {t(lang, "common.viewProjects")}
//               <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
//             </Link>
//             <Link href="/contact" className="flex items-center gap-2 px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-xl hover:bg-white/5 hover:border-[#C9A227]/50 transition-all duration-300">
//               <Phone className="w-5 h-5" />
//               {t(lang, "common.contactUs")}
//             </Link>
//           </div>
//           <div className="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
//             <div className="w-6 h-10 rounded-full border-2 border-white/20 flex items-start justify-center p-2">
//               <div className="w-1.5 h-3 bg-[#C9A227] rounded-full animate-pulse" />
//             </div>
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           STATS BAR
//           ═══════════════════════════════════════════ */}
//       <section className="relative py-16 bg-[#0A1628] border-y border-white/5">
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
//           <div className="grid grid-cols-2 lg:grid-cols-4 gap-8">
//             {stats.map((stat, idx) => {
//               const { count, ref } = useCountUp(stat.value);
//               const Icon = stat.icon;
//               return (
//                 <div key={idx} ref={ref} className="text-center group">
//                   <div className="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#C9A227]/10 mb-4 group-hover:bg-[#C9A227]/20 transition-colors">
//                     <Icon className="w-7 h-7 text-[#C9A227]" />
//                   </div>
//                   <div className="text-4xl lg:text-5xl font-bold text-white mb-2">
//                     {count}<span className="text-[#C9A227]">{stat.suffix}</span>
//                   </div>
//                   <p className="text-white/50 text-sm">{t(lang, stat.labelKey)}</p>
//                 </div>
//               );
//             })}
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           ABOUT HGC
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative">
//         <div className="absolute top-0 right-0 w-1/2 h-full bg-[#C9A227]/[0.02]" />
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
//           <div className="grid lg:grid-cols-2 gap-16 items-center">
//             <div>
//               <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-6">
//                 <Award className="w-4 h-4" />
//                 {lang === "en" ? "About HGC" : lang === "dari" ? "درباره گروپ حافظ" : "د حافظ ګروپ په اړه"}
//               </div>
//               <h2 className="text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
//                 {lang === "en" ? (<>Leading Afghan Conglomerate Since <span className="text-[#C9A227]">2001</span></>)
//                   : lang === "dari" ? (<>گروپ پیشرو افغان از سال <span className="text-[#C9A227]">۲۰۰۱</span></>)
//                   : (<>مخکښ افغان ګروپ له <span className="text-[#C9A227]">۲۰۰۱</span> کال راهیسې</>)}
//               </h2>
//               <p className="text-white/60 text-lg leading-relaxed mb-6">
//                 {lang === "en" ? "Hafez Group of Companies is a leading Afghan conglomerate operating in construction, mining, logistics, and financial services. With over 200 completed projects across 38+ provinces, we are transforming Afghanistan's infrastructure landscape."
//                   : lang === "dari" ? "گروپ کمپنی های حافظ یک گروپ پیشرو افغان است که در ساختمان، استخراج معادن، لوژستیک و خدمات مالی فعالیت می کند. با بیش از ۲۰۰ پروژه تکمیل شده در ۳۸+ ولایت، ما چشم انداز زیرساخت های افغانستان را تغییر می دهیم."
//                   : "د حافظ شرکتونو ګروپ یو مخکښ افغان ګروپ دی چې په جوړولو، د کانونو استخراج، لوجستیک او مالي خدماتو کې فعالیت کوي. په ۳۸+ ولایتونو کې د ۲۰۰+ بشپړو شویو پروژو سره، موږ د افغانستان د زیربنا منظره بدلوو."}
//               </p>
//               <p className="text-white/60 text-lg leading-relaxed mb-8">
//                 {lang === "en" ? "Our group comprises six specialized companies, each bringing unique expertise to deliver comprehensive solutions for government agencies, international organizations, and private sector clients."
//                   : lang === "dari" ? "گروپ ما شامل شش شرکت تخصصی است که هر کدام تخصص منحصر به فردی را برای ارائه راه حل های جامع به سازمان های دولتی، سازمان های بین المللی و مشتریان بخش خصوصی به ارمغان می آورند."
//                   : "زموږ ګروپ شپږ تخصصي شرکتونه لري، هر یو یې د دولتي ادارو، نړیوالو سازمانونو او خصوصي سکتور پیرودونکو ته جامع حلونه وړاندې کولو لپاره ځانګړې مهارت راوړي."}
//               </p>
//               <div className="flex flex-wrap gap-4 mb-8">
//                 {[{ icon: CheckCircle2, text: "ISO Certified", textDari: "گواهی ISO" },
//                   { icon: CheckCircle2, text: "AISA Licensed", textDari: "جواز AISA" },
//                   { icon: CheckCircle2, text: "Ministry Approved", textDari: "تایید وزارت" }].map((item, i) => (
//                   <div key={i} className="flex items-center gap-2 text-white/70">
//                     <item.icon className="w-5 h-5 text-[#C9A227]" />
//                     <span>{lang === "en" ? item.text : item.textDari}</span>
//                   </div>
//                 ))}
//               </div>
//               <Link href="/about" className="inline-flex items-center gap-2 text-[#C9A227] font-semibold hover:gap-3 transition-all">
//                 {t(lang, "common.readMore")}
//                 <ArrowRight className="w-5 h-5" />
//               </Link>
//             </div>
//             <div className="relative">
//               <div className="grid grid-cols-2 gap-4">
//                 <div className="space-y-4">
//                   <div className="aspect-[4/5] rounded-2xl bg-[#C9A227]/10 border border-[#C9A227]/20 overflow-hidden relative">
//                     <div className="w-full h-full bg-[#C9A227]/5 flex items-center justify-center">
//                       <Building2 className="w-16 h-16 text-[#C9A227]/30" />
//                     </div>
//                   </div>
//                   <div className="aspect-square rounded-2xl bg-[#1A237E]/10 border border-[#1A237E]/20 overflow-hidden relative">
//                     <div className="w-full h-full bg-[#1A237E]/5 flex items-center justify-center">
//                       <Mountain className="w-12 h-12 text-[#1A237E]/30" />
//                     </div>
//                   </div>
//                 </div>
//                 <div className="space-y-4 pt-8">
//                   <div className="aspect-square rounded-2xl bg-[#2E7D32]/10 border border-[#2E7D32]/20 overflow-hidden relative">
//                     <div className="w-full h-full bg-[#2E7D32]/5 flex items-center justify-center">
//                       <Road className="w-12 h-12 text-[#2E7D32]/30" />
//                     </div>
//                   </div>
//                   <div className="aspect-[4/5] rounded-2xl bg-[#00838F]/10 border border-[#00838F]/20 overflow-hidden relative">
//                     <div className="w-full h-full bg-[#00838F]/5 flex items-center justify-center">
//                       <Truck className="w-16 h-16 text-[#00838F]/30" />
//                     </div>
//                   </div>
//                 </div>
//               </div>
//               <div className="absolute -bottom-6 -left-6 bg-[#0A1628] border border-[#C9A227]/30 rounded-2xl p-4 shadow-xl">
//                 <div className="flex items-center gap-3">
//                   <div className="w-12 h-12 rounded-xl bg-[#C9A227]/10 flex items-center justify-center">
//                     <TrendingUp className="w-6 h-6 text-[#C9A227]" />
//                   </div>
//                   <div>
//                     <p className="text-white font-bold text-lg">200+</p>
//                     <p className="text-white/50 text-xs">
//                       {lang === "en" ? "Projects Done" : lang === "dari" ? "پروژه انجام شده" : "ترسره شوې پروژې"}
//                     </p>
//                   </div>
//                 </div>
//               </div>
//             </div>
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           OUR COMPANIES
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative overflow-hidden">
//         <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_#C9A227/5_0%,_transparent_50%)]" />
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
//           <div className="text-center mb-16">
//             <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
//               {lang === "en" ? "Our Group" : lang === "dari" ? "گروپ ما" : "زموږ ګروپ"}
//             </span>
//             <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
//               {lang === "en" ? (<>Six Specialized <span className="text-[#C9A227]">Companies</span></>)
//                 : lang === "dari" ? (<>شش شرکت <span className="text-[#C9A227]">تخصصی</span></>)
//                 : (<>شپږ <span className="text-[#C9A227]">تخصصي</span> شرکتونه</>)}
//             </h2>
//             <p className="text-white/50 max-w-2xl mx-auto">
//               {lang === "en" ? "Each company brings unique expertise to deliver comprehensive solutions across Afghanistan."
//                 : lang === "dari" ? "هر شرکت تخصص منحصر به فردی را برای ارائه راه حل های جامع در سراسر افغانستان به ارمغان می آورد."
//                 : "هر شرکت ځانګړې مهارت راوړي ترڅو په افغانستان کې جامع حلونه وړاندې کړي."}
//             </p>
//           </div>
//           <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
//             {companies.map((company) => {
//               const Icon = company.icon;
//               const isHovered = hoveredCompany === company.slug;
//               return (
//                 <Link key={company.slug} href={`/companies/${company.slug}`}
//                   onMouseEnter={() => setHoveredCompany(company.slug)}
//                   onMouseLeave={() => setHoveredCompany(null)}
//                   className="group relative bg-white/[0.02] border border-white/5 rounded-2xl p-6 hover:bg-white/[0.04] hover:border-white/10 transition-all duration-500 overflow-hidden">
//                   <div className="absolute top-0 left-0 right-0 h-1 rounded-t-2xl transition-all duration-500"
//                     style={{ backgroundColor: isHovered ? company.accent : "transparent", opacity: isHovered ? 1 : 0 }} />
//                   <div className="flex items-start gap-4">
//                     <div className="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-500"
//                       style={{ backgroundColor: isHovered ? `${company.accent}25` : `${company.accent}10` }}>
//                       <Icon className="w-7 h-7 transition-colors duration-300" style={{ color: company.accent }} />
//                     </div>
//                     <div className="flex-1 min-w-0">
//                       <h3 className="text-white font-bold text-lg mb-1 group-hover:text-[#C9A227] transition-colors">
//                         {t(lang, `companies.${company.slug}.name`)}
//                       </h3>
//                       <p className="text-white/40 text-sm mb-3">{t(lang, `companies.${company.slug}.desc`)}</p>
//                       <span className="inline-flex items-center gap-1 text-sm text-[#C9A227]/70 group-hover:text-[#C9A227] transition-colors">
//                         {t(lang, "common.visit")}
//                         <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
//                       </span>
//                     </div>
//                   </div>
//                 </Link>
//               );
//             })}
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           FEATURED PRODUCTS — NEW
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative overflow-hidden">
//         <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_#C9A227/5_0%,_transparent_50%)]" />
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
//           <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16">
//             <div>
//               <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
//                 <Package className="w-4 h-4 inline mr-2" />
//                 {lang === "en" ? "Products & Services" : lang === "dari" ? "محصولات و خدمات" : "محصولات او خدمات"}
//               </span>
//               <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
//                 {lang === "en" ? (<>Featured <span className="text-[#C9A227]">Products</span></>)
//                   : lang === "dari" ? (<>محصولات <span className="text-[#C9A227]">برجسته</span></>)
//                   : (<>ټاکل شوي <span className="text-[#C9A227]">محصولات</span></>)}
//               </h2>
//               <p className="text-white/50 max-w-xl">
//                 {lang === "en" ? "High-quality construction materials, energy solutions, and logistics services from our own production facilities."
//                   : lang === "dari" ? "مواد ساختمانی با کیفیت بالا، راه حل های انرژی و خدمات لوژستیک از تاسیسات تولیدی خود ما."
//                   : "د لوړ کیفیت جوړونې مواد، د انرژي حلونه، او د لوجستیکي خدماتو زموږ د خپلو تولیدي تاسیساتو څخه."}
//               </p>
//             </div>
//             <Link href="/products" className="mt-4 lg:mt-0 inline-flex items-center gap-2 text-[#C9A227] font-semibold hover:gap-3 transition-all">
//               {lang === "en" ? "View All Products" : lang === "dari" ? "مشاهده همه محصولات" : "ټول محصولات وګورئ"}
//               <ArrowRight className="w-5 h-5" />
//             </Link>
//           </div>
//           <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
//             {featuredProducts.map((product) => {
//               const Icon = product.icon;
//               return (
//                 <div key={product.id} className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-[#C9A227]/20 transition-all duration-500">
//                   <div className="aspect-[16/10] relative overflow-hidden bg-[#0A1628]">
//                     <div className="absolute inset-0 bg-[#C9A227]/5 flex items-center justify-center">
//                       <Icon className="w-16 h-16 text-[#C9A227]/20" />
//                     </div>
//                     <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors" />
//                     <div className="absolute top-4 left-4">
//                       <span className="px-3 py-1 rounded-full bg-[#0A1628]/80 text-[#C9A227] text-xs font-medium border border-[#C9A227]/20">
//                         {lang === "en" ? product.category : product.categoryDari}
//                       </span>
//                     </div>
//                   </div>
//                   <div className="p-6">
//                     <h3 className="text-white font-bold text-xl mb-2 group-hover:text-[#C9A227] transition-colors">
//                       {lang === "en" ? product.name : lang === "dari" ? product.nameDari : product.namePashto}
//                     </h3>
//                     <p className="text-white/50 text-sm leading-relaxed mb-4">
//                       {lang === "en" ? product.description : product.descriptionDari}
//                     </p>
//                     <ul className="space-y-2">
//                       {product.specs.map((spec, i) => (
//                         <li key={i} className="flex items-center gap-2 text-white/40 text-xs">
//                           <CheckCircle2 className="w-3.5 h-3.5 text-[#C9A227]/60" />
//                           {spec}
//                         </li>
//                       ))}
//                     </ul>
//                   </div>
//                 </div>
//               );
//             })}
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           SECTORS
//           ═══════════════════════════════════════════ */}
//       <section className="py-20 bg-[#0A1628] border-y border-white/5">
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
//           <div className="text-center mb-12">
//             <h3 className="text-white/40 text-sm uppercase tracking-wider mb-2">
//               {lang === "en" ? "Business Verticals" : lang === "dari" ? "حوزه های کاری" : "د سوداګرۍ عمودي"}
//             </h3>
//             <p className="text-white/60 text-lg">
//               {lang === "en" ? "Mining, Construction, Energy, and General Trading solutions driving sustainable growth across Afghanistan."
//                 : lang === "dari" ? "راه حل های استخراج معادن، ساخت و ساز، انرژی و تجارت عمومی که رشد پایدار را در سراسر افغانستان هدایت می کنند."
//                 : "د کانونو استخراج، جوړونه، انرژي، او عمومي سوداګرۍ حلونه چې په افغانستان کې د پایدار ودې هدایت کوي."}
//             </p>
//           </div>
//           <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
//             {sectors.map((sector) => {
//               const Icon = sector.icon;
//               return (
//                 <div key={sector.name} className="group text-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.05] hover:border-[#C9A227]/20 transition-all duration-300">
//                   <div className="w-12 h-12 mx-auto rounded-xl bg-[#C9A227]/10 flex items-center justify-center mb-3 group-hover:bg-[#C9A227]/20 transition-colors">
//                     <Icon className="w-6 h-6 text-[#C9A227]" />
//                   </div>
//                   <p className="text-white font-medium text-sm mb-1">{lang === "en" ? sector.name : sector.nameDari}</p>
//                   <p className="text-[#C9A227] text-xs font-bold">{sector.count}+</p>
//                 </div>
//               );
//             })}
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           FEATURED PROJECTS
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative">
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
//           <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-12">
//             <div>
//               <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
//                 {lang === "en" ? "Portfolio" : lang === "dari" ? "نمونه کارها" : "پورټفولیو"}
//               </span>
//               <h2 className="text-4xl lg:text-5xl font-bold text-white">
//                 {lang === "en" ? (<>Featured <span className="text-[#C9A227]">Projects</span></>)
//                   : lang === "dari" ? (<>پروژه های <span className="text-[#C9A227]">برجسته</span></>)
//                   : (<>ټاکل شوې <span className="text-[#C9A227]">پروژې</span></>)}
//               </h2>
//             </div>
//             <Link href="/projects" className="mt-4 lg:mt-0 inline-flex items-center gap-2 text-[#C9A227] font-semibold hover:gap-3 transition-all">
//               {t(lang, "common.viewAll")}
//               <ArrowRight className="w-5 h-5" />
//             </Link>
//           </div>
//           <div className="flex flex-wrap gap-2 mb-10">
//             {projectFilters.map((filter) => (
//               <button key={filter.key} onClick={() => setActiveProjectFilter(filter.key)}
//                 className={`px-5 py-2 rounded-lg text-sm font-medium transition-all ${
//                   activeProjectFilter === filter.key ? "bg-[#C9A227] text-[#0A1628]" : "bg-white/5 text-white/60 hover:bg-white/10 hover:text-white"
//                 }`}>
//                 {lang === "en" ? filter.label : filter.labelDari}
//               </button>
//             ))}
//           </div>
//           <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
//             {filteredProjects.map((project) => (
//               <Link key={project.id} href={`/projects/${project.id}`}
//                 className="group relative bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:border-[#C9A227]/20 transition-all duration-500">
//                 <div className="aspect-[4/3] relative overflow-hidden">
//                   <div className="absolute inset-0 bg-[#C9A227]/5 flex items-center justify-center">
//                     <Building2 className="w-12 h-12 text-[#C9A227]/20" />
//                   </div>
//                   <div className="absolute inset-0 bg-[#0A1628]/40 group-hover:bg-[#0A1628]/20 transition-colors" />
//                   <div className="absolute top-4 left-4">
//                     <span className={`px-3 py-1 rounded-full text-xs font-medium ${
//                       project.status === "completed" ? "bg-green-500/20 text-green-400 border border-green-500/20" : "bg-amber-500/20 text-amber-400 border border-amber-500/20"
//                     }`}>
//                       {project.status === "completed" ? (lang === "en" ? "Completed" : lang === "dari" ? "تکمیل شده" : "بشپړه شوې")
//                         : (lang === "en" ? "Ongoing" : lang === "dari" ? "در حال اجرا" : "جریان لري")}
//                     </span>
//                   </div>
//                 </div>
//                 <div className="p-5">
//                   <div className="flex items-center gap-2 text-white/40 text-xs mb-2">
//                     <MapPin className="w-3.5 h-3.5" />
//                     {lang === "en" ? project.location : project.locationDari}
//                   </div>
//                   <h3 className="text-white font-bold text-lg mb-2 group-hover:text-[#C9A227] transition-colors line-clamp-2">
//                     {lang === "en" ? project.title : project.titleDari}
//                   </h3>
//                   <div className="flex items-center gap-4 text-xs text-white/40 mb-3">
//                     <span className="flex items-center gap-1"><DollarSign className="w-3.5 h-3.5" />{project.budget}</span>
//                     <span className="flex items-center gap-1"><Calendar className="w-3.5 h-3.5" />{project.duration}</span>
//                   </div>
//                   <p className="text-white/30 text-xs line-clamp-2">{lang === "en" ? project.client : project.clientDari}</p>
//                 </div>
//               </Link>
//             ))}
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           GLOBAL PARTNERSHIP — NEW
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative overflow-hidden">
//         <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_#C9A227/5_0%,_transparent_50%)]" />
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
//           <div className="text-center mb-16">
//             <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
//               <Handshake className="w-4 h-4 inline mr-2" />
//               {lang === "en" ? "Global Reach" : lang === "dari" ? "دسترسی جهانی" : "نړیواله رسي"}
//             </span>
//             <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
//               {lang === "en" ? (<>Global <span className="text-[#C9A227]">Partnerships</span></>)
//                 : lang === "dari" ? (<>مشارکت های <span className="text-[#C9A227]">جهانی</span></>)
//                 : (<>نړیوال <span className="text-[#C9A227]">شریکۍ</span></>)}
//             </h2>
//             <p className="text-white/50 max-w-2xl mx-auto">
//               {lang === "en" ? "Strategic alliances with international organizations, government agencies, and development partners driving Afghanistan's growth."
//                 : lang === "dari" ? "اتحادهای استراتژیک با سازمان های بین المللی، آژانس های دولتی و شرکای توسعه که رشد افغانستان را هدایت می کنند."
//                 : "د نړیوالو سازمانونو، دولتي ادارو، او د پراختیا ملګرو سره ستراتیژیکې ټولګټې چې د افغانستان وده هدایت کوي."}
//             </p>
//           </div>
//           <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
//             {globalPartners.map((partner) => {
//               const isHovered = hoveredPartner === partner.name;
//               return (
//                 <div key={partner.name} onMouseEnter={() => setHoveredPartner(partner.name)} onMouseLeave={() => setHoveredPartner(null)}
//                   className="group relative bg-white/[0.02] border border-white/5 rounded-2xl p-6 hover:bg-white/[0.04] hover:border-[#C9A227]/20 transition-all duration-500">
//                   <div className="flex items-start justify-between mb-4">
//                     <div className="flex items-center gap-3">
//                       <div className="w-12 h-12 rounded-xl bg-[#C9A227]/10 border border-[#C9A227]/20 flex items-center justify-center">
//                         <span className="text-[#C9A227] font-bold text-sm">{partner.logo}</span>
//                       </div>
//                       <div>
//                         <h3 className="text-white font-bold text-lg">{partner.name}</h3>
//                         <p className="text-white/40 text-xs">{partner.fullName}</p>
//                       </div>
//                     </div>
//                     <span className="px-2 py-1 rounded-md bg-white/5 text-white/40 text-xs">{lang === "en" ? partner.type : partner.typeDari}</span>
//                   </div>
//                   <div className="flex items-center gap-6 mb-4">
//                     <div>
//                       <p className="text-[#C9A227] font-bold text-2xl">{partner.projects}</p>
//                       <p className="text-white/40 text-xs">{lang === "en" ? "Projects" : lang === "dari" ? "پروژه" : "پروژې"}</p>
//                     </div>
//                     <div className="w-px h-10 bg-white/10" />
//                     <div>
//                       <p className="text-white font-bold text-2xl">{partner.since}</p>
//                       <p className="text-white/40 text-xs">{lang === "en" ? "Since" : lang === "dari" ? "از" : "له"}</p>
//                     </div>
//                   </div>
//                   <p className="text-white/50 text-sm leading-relaxed mb-4">{partner.description}</p>
//                   <div className="flex items-center gap-2 text-[#C9A227]/70 group-hover:text-[#C9A227] text-sm transition-colors">
//                     <span>{lang === "en" ? "Learn more" : lang === "dari" ? "بیشتر بدانید" : "نور معلومات"}</span>
//                     <ArrowUpRight className="w-4 h-4" />
//                   </div>
//                 </div>
//               );
//             })}
//           </div>
//           <div className="mt-16 p-8 rounded-2xl bg-[#C9A227]/5 border border-[#C9A227]/10">
//             <div className="flex flex-col lg:flex-row items-center justify-between gap-6">
//               <div className="flex items-center gap-4">
//                 <div className="w-16 h-16 rounded-2xl bg-[#C9A227]/10 flex items-center justify-center">
//                   <Globe className="w-8 h-8 text-[#C9A227]" />
//                 </div>
//                 <div>
//                   <h3 className="text-white font-bold text-xl">
//                     {lang === "en" ? "Trusted Worldwide" : lang === "dari" ? "مورد اعتماد در سراسر جهان" : "په نړیواله کچه باوري"}
//                   </h3>
//                   <p className="text-white/50 text-sm">
//                     {lang === "en" ? "Partnering with leading international organizations for over two decades."
//                       : lang === "dari" ? "مشارکت با سازمان های بین المللی برجسته برای بیش از دو دهه."
//                       : "له دوو لسیزو زیاته د مخکښو نړیوالو سازمانونو سره شریکي."}
//                   </p>
//                 </div>
//               </div>
//               <div className="flex items-center gap-8">
//                 <div className="text-center">
//                   <p className="text-[#C9A227] font-bold text-3xl">250+</p>
//                   <p className="text-white/40 text-xs">{lang === "en" ? "Joint Projects" : lang === "dari" ? "پروژه مشترک" : "مشترکې پروژې"}</p>
//                 </div>
//                 <div className="text-center">
//                   <p className="text-[#C9A227] font-bold text-3xl">$500M+</p>
//                   <p className="text-white/40 text-xs">{lang === "en" ? "Contract Value" : lang === "dari" ? "ارزش قرارداد" : "د قرارداد ارزښت"}</p>
//                 </div>
//                 <div className="text-center">
//                   <p className="text-[#C9A227] font-bold text-3xl">15+</p>
//                   <p className="text-white/40 text-xs">{lang === "en" ? "Countries" : lang === "dari" ? "کشور" : "هیوادونه"}</p>
//                 </div>
//               </div>
//             </div>
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           WHY CHOOSE HGC
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative overflow-hidden">
//         <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,_#C9A227/5_0%,_transparent_50%)]" />
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
//           <div className="text-center mb-16">
//             <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
//               {lang === "en" ? "Why Us" : lang === "dari" ? "چرا ما" : "ولې موږ"}
//             </span>
//             <h2 className="text-4xl lg:text-5xl font-bold text-white mb-4">
//               {lang === "en" ? (<>Why Choose <span className="text-[#C9A227]">HGC</span></>)
//                 : lang === "dari" ? (<>چرا <span className="text-[#C9A227]">گروپ حافظ</span> را انتخاب کنیم</>)
//                 : (<>ولې <span className="text-[#C9A227]">حافظ ګروپ</span> غوره کړئ</>)}
//             </h2>
//           </div>
//           <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
//             {whyChoose.map((item, idx) => {
//               const Icon = item.icon;
//               return (
//                 <div key={idx} className="group relative bg-white/[0.02] border border-white/5 rounded-2xl p-8 hover:bg-white/[0.04] hover:border-[#C9A227]/20 transition-all duration-500">
//                   <div className="w-16 h-16 rounded-2xl bg-[#C9A227]/10 flex items-center justify-center mb-6 group-hover:bg-[#C9A227]/20 group-hover:scale-110 transition-all duration-500">
//                     <Icon className="w-8 h-8 text-[#C9A227]" />
//                   </div>
//                   <h3 className="text-white font-bold text-xl mb-3">{lang === "en" ? item.title : item.titleDari}</h3>
//                   <p className="text-white/50 text-sm leading-relaxed">{lang === "en" ? item.desc : item.descDari}</p>
//                 </div>
//               );
//             })}
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           CLIENTS / PARTNERS LOGO BAR
//           ═══════════════════════════════════════════ */}
//       <section className="py-20 bg-[#0A1628] border-y border-white/5">
//         <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
//           <div className="text-center mb-12">
//             <h3 className="text-white/40 text-sm uppercase tracking-wider">
//               {lang === "en" ? "Trusted by Leading Organizations" : lang === "dari" ? "مورد اعتماد سازمان های برجسته" : "د مخکښو سازمانونو لخوا باوري"}
//             </h3>
//           </div>
//           <div className="flex flex-wrap items-center justify-center gap-8 lg:gap-16">
//             {clients.map((client) => (
//               <div key={client.name} className="group flex items-center gap-3 px-6 py-3 rounded-xl bg-white/[0.02] border border-white/5 hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300">
//                 <div className="w-10 h-10 rounded-lg bg-[#C9A227]/10 flex items-center justify-center">
//                   <span className="text-[#C9A227] font-bold text-xs">{client.abbr}</span>
//                 </div>
//                 <span className="text-white/40 group-hover:text-white/70 text-sm font-medium transition-colors">{client.name}</span>
//               </div>
//             ))}
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           TESTIMONIALS
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative">
//         <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
//           <div className="text-center mb-16">
//             <span className="inline-block px-4 py-1 rounded-full bg-[#C9A227]/10 text-[#C9A227] text-sm font-medium mb-4">
//               {lang === "en" ? "Testimonials" : lang === "dari" ? "نظرات" : "څرګندونې"}
//             </span>
//             <h2 className="text-4xl lg:text-5xl font-bold text-white">
//               {lang === "en" ? (<>What Our <span className="text-[#C9A227]">Clients Say</span></>)
//                 : lang === "dari" ? (<>مشتریان ما <span className="text-[#C9A227]">چه می گویند</span></>)
//                 : (<>زموږ <span className="text-[#C9A227]">پیرودونکي څه وايي</span></>)}
//             </h2>
//           </div>
//           <div className="relative">
//             <div className="bg-white/[0.02] border border-white/5 rounded-3xl p-8 lg:p-12 relative">
//               <Quote className="absolute top-8 left-8 w-12 h-12 text-[#C9A227]/10" />
//               <div className="relative z-10">
//                 <p className="text-white/80 text-lg lg:text-xl leading-relaxed mb-8 text-center italic">
//                   &ldquo;{lang === "en" ? testimonials[activeTestimonial].text : testimonials[activeTestimonial].textDari}&rdquo;
//                 </p>
//                 <div className="flex items-center justify-center gap-4">
//                   <div className="w-14 h-14 rounded-full bg-[#C9A227]/10 border-2 border-[#C9A227]/20 flex items-center justify-center">
//                     <Users className="w-6 h-6 text-[#C9A227]" />
//                   </div>
//                   <div className="text-center">
//                     <p className="text-white font-bold">{lang === "en" ? testimonials[activeTestimonial].author : testimonials[activeTestimonial].authorDari}</p>
//                     <p className="text-white/50 text-sm">{lang === "en" ? testimonials[activeTestimonial].role : testimonials[activeTestimonial].roleDari}</p>
//                   </div>
//                 </div>
//               </div>
//             </div>
//             <div className="flex items-center justify-center gap-3 mt-8">
//               {testimonials.map((_, idx) => (
//                 <button key={idx} onClick={() => setActiveTestimonial(idx)}
//                   className={`transition-all duration-300 rounded-full ${
//                     activeTestimonial === idx ? "w-8 h-2 bg-[#C9A227]" : "w-2 h-2 bg-white/20 hover:bg-white/40"
//                   }`} />
//               ))}
//             </div>
//           </div>
//         </div>
//       </section>

//       {/* ═══════════════════════════════════════════
//           CTA SECTION
//           ═══════════════════════════════════════════ */}
//       <section className="py-24 bg-[#0A1628] relative overflow-hidden">
//         <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_#C9A227/10_0%,_transparent_60%)]" />
//         <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
//           <h2 className="text-4xl lg:text-5xl font-bold text-white mb-6">
//             {lang === "en" ? (<>Ready to Start Your <span className="text-[#C9A227]">Project?</span></>)
//               : lang === "dari" ? (<>آماده شروع <span className="text-[#C9A227]">پروژه خود</span> هستید؟</>)
//               : (<>ستاسو <span className="text-[#C9A227]">پروژې</span> پیلولو لپاره چمتو یاست؟</>)}
//           </h2>
//           <p className="text-white/50 text-lg mb-10 max-w-2xl mx-auto">
//             {lang === "en" ? "Contact us for a free consultation and quotation. Our team of experts is ready to bring your vision to life."
//               : lang === "dari" ? "برای مشاوره رایگان و پیشنهاد قیمت با ما تماس بگیرید. تیم متخصصان ما آماده است چشم انداز شما را زنده کند."
//               : "د وړیا مشورې او قیمت وړاندیز لپاره موږ سره اړیکه ونیسئ. زموږ د متخصصینو ټیم ستاسو لید زنده کولو لپاره چمتو دی."}
//           </p>
//           <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
//             <Link href="/contact" className="group flex items-center gap-2 px-8 py-4 bg-[#C9A227] text-[#0A1628] font-bold rounded-xl hover:bg-[#C9A227]/90 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#C9A227]/20">
//               {t(lang, "common.getQuote")}
//               <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
//             </Link>
//             <a href="tel:+93711111694" className="flex items-center gap-2 px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-xl hover:bg-white/5 hover:border-[#C9A227]/50 transition-all duration-300">
//               <Phone className="w-5 h-5" />
//               {t(lang, "common.callUs")}
//             </a>
//           </div>
//         </div>
//       </section>
//     </div>
//   );
// }

import { Metadata } from "next";
import HeroSection from "./sections/HeroSection";
import StatsBar from "./sections/StatsBar";
import AboutSection from "./sections/AboutSection";
import CompaniesSection from "./sections/CompaniesSection";
import ProductsSection from "./sections/ProductsSection";
import SectorsSection from "./sections/SectorsSection";
import ProjectsSection from "./sections/ProjectsSection";
import PartnersSection from "./sections/PartnersSection";
import WhyChooseSection from "./sections/WhyChooseSection";
import ClientsSection from "./sections/ClientsSection";
import TestimonialsSection from "./sections/TestimonialsSection";
import CTASection from "./sections/CTASection";

export const metadata: Metadata = {
  title: "Hafez Group of Companies | Building Afghanistan's Future",
  description:
    "Hafez Group of Companies (HGC) — Construction, Mining, Logistics & Financial Services. 24+ years, 200+ projects, 38+ provinces across Afghanistan.",
};

export default function HomePage() {
  return (
    <div className="overflow-hidden">
      <HeroSection />
      <StatsBar />
      <AboutSection />
      <CompaniesSection />
      <ProductsSection />
      <SectorsSection />
      <ProjectsSection />
      <PartnersSection />
      <WhyChooseSection />
      <ClientsSection />
      <TestimonialsSection />
      <CTASection />
    </div>
  );
}