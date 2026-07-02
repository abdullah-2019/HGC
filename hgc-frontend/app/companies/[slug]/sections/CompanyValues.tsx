"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { Shield, Handshake, Lightbulb, Heart, Scale, Leaf } from "lucide-react";

interface CompanyValuesProps {
  company: {
    name: string;
    accent_color: string;
  };
}

export default function CompanyValues({ company }: CompanyValuesProps) {
  const { lang, dir } = useI18n();

  const values = [
    {
      icon: Shield,
      title:
        lang === "en" ? "Integrity" : lang === "dari" ? "صداقت" : "صمیمیت",
      desc:
        lang === "en"
          ? "We uphold the highest ethical standards in all our business dealings."
          : lang === "dari"
          ? "ما بالاترین معیارهای اخلاقی را در تمام معاملات تجاری خود رعایت می‌کنیم."
          : "موږ په خپلو ټولو سوداګریزو معاملاتو کې تر ټولو لوړ اخلاقي معیارونه ساتو.",
    },
    {
      icon: Handshake,
      title:
        lang === "en" ? "Commitment" : lang === "dari" ? "تعهد" : "تعهد",
      desc:
        lang === "en"
          ? "Dedicated to delivering on our promises with unwavering reliability."
          : lang === "dari"
          ? "متعهد به تحویل وعده‌های خود با قابلیت اعتماد بی‌چون و چرا."
          : "د خپلو ژمنو د پلي کولو لپاره د بې باورۍ اعتماد سره وقف شوي.",
    },
    {
      icon: Lightbulb,
      title:
        lang === "en" ? "Innovation" : lang === "dari" ? "نوآوری" : "نوښت",
      desc:
        lang === "en"
          ? "Continuously seeking new solutions to drive progress and growth."
          : lang === "dari"
          ? "به طور مداوم به دنبال راه‌حل‌های جدید برای پیشبرد پیشرفت و رشد هستیم."
          : "د پرمختګ او ودې لپاره تل نوي حلونه پلټو.",
    },
    {
      icon: Heart,
      title:
        lang === "en" ? "Excellence" : lang === "dari" ? "برتری" : "بریا",
      desc:
        lang === "en"
          ? "Striving for the highest quality in every project we undertake."
          : lang === "dari"
          ? "تلاش برای بالاترین کیفیت در هر پروژه‌ای که بر عهده می‌گیریم."
          : "په هره پروژه کې چې موږ یې پیل کوو د تر ټولو لوړ کیفیت لپاره هڅه کول.",
    },
    {
      icon: Scale,
      title:
        lang === "en" ? "Accountability" : lang === "dari" ? "پاسخگویی" : "د ځواب ورکولو مسؤلیت",
      desc:
        lang === "en"
          ? "Taking responsibility for our actions and their impact on society."
          : lang === "dari"
          ? "مسئولیت اقدامات خود و تأثیر آنها بر جامعه را بر عهده می‌گیریم."
          : "د خپلو کړنو او د هغوی د ټولنې پر اغیز مسؤلیت منو.",
    },
    {
      icon: Leaf,
      title:
        lang === "en" ? "Sustainability" : lang === "dari" ? "پایداری" : "دوامداره والی",
      desc:
        lang === "en"
          ? "Building a better future through responsible and sustainable practices."
          : lang === "dari"
          ? "ساختن آینده‌ای بهتر از طریق شیوه‌های مسئولانه و پایدار."
          : "د مسؤلانه او دوامداره کړنو له لارې غوره راتلونکې جوړول.",
    },
  ];

  return (
    <section className="py-20" dir={dir}>
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
            {lang === "en" ? "Core Values" : lang === "dari" ? "ارزش‌های اصلی" : "اصلي ارزښتونه"}
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {lang === "en" ? "What We Stand For" : lang === "dari" ? "آنچه ما برای آن می‌ایستیم" : "هغه څه چې موږ ولاړ یو"}
          </h2>
        </motion.div>

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {values.map((value, index) => (
            <motion.div
              key={value.title}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="group rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:bg-white/10 hover:border-white/20"
            >
              <div
                className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl transition-transform group-hover:scale-110"
                style={{ backgroundColor: `${company.accent_color}15` }}
              >
                <value.icon size={28} style={{ color: company.accent_color }} />
              </div>
              <h3 className="mb-2 text-lg font-bold text-white">{value.title}</h3>
              <p className="text-white/60 text-sm leading-relaxed">{value.desc}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}