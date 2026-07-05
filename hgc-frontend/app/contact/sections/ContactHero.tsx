"use client";

import Image from "next/image";
import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

export default function ContactHero() {
  const { lang, dir } = useI18n();

  return (
    <section
      className="relative h-[60vh] min-h-[400px] w-full overflow-hidden"
      dir={dir}
    >
      <div className="absolute inset-0">
        <Image
          src="/images/placeholder.png"
          alt="HGC Contact"
          fill
          className="object-cover"
          priority
        />
        <div className="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70" />
      </div>

      <div className="relative z-10 flex h-full items-center justify-center px-4">
        <div className="text-center">
          <motion.h1
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="mb-4 text-4xl font-bold text-white md:text-5xl lg:text-6xl"
          >
            {t(lang, "contact.hero_title")}
          </motion.h1>
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.2 }}
            className="mx-auto max-w-2xl text-lg text-white/90 md:text-xl"
          >
            {t(lang, "contact.hero_subtitle")}
          </motion.p>
        </div>
      </div>
    </section>
  );
}
