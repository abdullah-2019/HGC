"use client";

import { motion } from "framer-motion";
import { MapPin } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

export default function ContactMap() {
  const { lang, dir } = useI18n();

  return (
    <section className="bg-[#0A1628] py-20" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
          className="mb-12 text-center"
        >
          <div className="mb-4 inline-flex items-center gap-2 rounded-full bg-[#C9A227]/10 border border-[#C9A227]/20 px-4 py-2 text-[#C9A227]">
            <MapPin size={18} />
            <span className="text-sm font-medium">{t(lang, "contact.find_us")}</span>
          </div>
          <h2 className="text-3xl font-bold text-white md:text-4xl">
            {t(lang, "contact.find_us")}
          </h2>
        </motion.div>

        {/* Kabul Map - Primary Office */}
        <motion.div
          initial={{ opacity: 0, y: 40 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
          className="overflow-hidden rounded-2xl bg-white/5 border border-white/10"
        >
          <div className="relative h-[450px] w-full md:h-[500px]">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3286.0!2d69.1760!3d34.5320!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDMxJzU1LjIiTiA2OcKwMTAnMzMuNiJF!5e0!3m2!1sen!2s!4v1"
              width="100%"
              height="100%"
              style={{ border: 0 }}
              allowFullScreen
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
              title="HGC Kabul Office Location"
              className="grayscale-[20%] hover:grayscale-0 transition-all duration-500"
            />

            {/* Map Overlay Card */}
            <div
              className={`absolute bottom-6 max-w-sm rounded-xl bg-[#0A1628]/95 border border-white/10 p-6 shadow-2xl backdrop-blur-sm ${
                dir === "rtl" ? "right-6" : "left-6"
              }`}
            >
              <div className="flex items-start gap-4">
  <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#C9A227]/15 text-[#C9A227]">
    {/* Slightly reduced icon container and size for visual balance */}
    <MapPin size={18} />
  </div>
  <div>
    {/* Changed text-lg to text-base (or use text-sm if you want it even smaller) */}
    <h4 className="text-base font-bold text-white">
      {t(lang, "contact.kabul_office")}
    </h4>
    {/* Changed text-sm to text-xs */}
    <p className="mt-1 text-xs text-white/60">
      Share-Now, Old Taimani, Street No 3, Kabul, Afghanistan
    </p>
    {/* Changed text-sm to text-xs */}
    <a
      href="tel:+93711111694"
      className="mt-1.5 inline-block text-xs font-medium text-[#C9A227] hover:text-[#D4AF37]"
    >
      +93 (0) 711 111 694
    </a>
  </div>
</div>

            </div>
          </div>
        </motion.div>
      </div>
    </section>
  );
}

