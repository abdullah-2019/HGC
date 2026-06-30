"use client";

import { motion } from "framer-motion";
import { Mail, Phone, MapPin, Clock } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

export default function ContactInfo() {
  const { lang, dir } = useI18n();

  const offices = [
    {
      city: t(lang, "contact.kabul_office"),
      address: "Share-Now, Old Taimani, Street No 3, Kabul, Afghanistan",
      phone: "+93 (0) 711 111 694",
      icon: MapPin,
    },
    {
      city: t(lang, "contact.dubai_office"),
      address: "Meydan Grandstand, 6th Floor, Meydan Road, Nad Al Sheba, Dubai, U.A.E.",
      phone: "+971 4 000 0000",
      icon: MapPin,
    },
    {
      city: t(lang, "contact.karachi_office"),
      address: "G-26, SGM Memon Goth Industrial Estate, Phase-II, Memon Goth Area, Malir, Karachi, Pakistan",
      phone: "+92 21 0000 0000",
      icon: MapPin,
    },
  ];

  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: { staggerChildren: 0.15 },
    },
  };

  const itemVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: { opacity: 1, y: 0, transition: { duration: 0.6 } },
  };

  return (
    <section className="bg-[#0A1628] py-20" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: "-100px" }}
          variants={containerVariants}
          className="grid gap-8 md:grid-cols-2 lg:grid-cols-4"
        >
          {/* Email Card */}
          <motion.div
            variants={itemVariants}
            className="rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-[#C9A227]/30"
          >
            <div className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#C9A227]/15 text-[#C9A227]">
              <Mail size={28} />
            </div>
            <h3 className="mb-2 text-xl font-bold text-white">{t(lang, "contact.email_address")}</h3>
            <p className="text-white/60">info@hcrc-af.com</p>
          </motion.div>

          {/* Phone Card */}
          <motion.div
            variants={itemVariants}
            className="rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-[#C9A227]/30"
          >
            <div className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#C9A227]/15 text-[#C9A227]">
              <Phone size={28} />
            </div>
            <h3 className="mb-2 text-xl font-bold text-white">{t(lang, "contact.call_us")}</h3>
            <p className="text-white/60">+93 (0) 711 111 694</p>
          </motion.div>

          {/* Office Hours */}
          <motion.div
            variants={itemVariants}
            className="rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-[#C9A227]/30"
          >
            <div className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#C9A227]/15 text-[#C9A227]">
              <Clock size={28} />
            </div>
            <h3 className="mb-2 text-xl font-bold text-white">{t(lang, "contact.office_hours")}</h3>
            <p className="text-white/60">{t(lang, "contact.mon_fri")}</p>
            <p className="text-white/60">{t(lang, "contact.time")}</p>
          </motion.div>

          {/* Social / Follow Us */}
          <motion.div
            variants={itemVariants}
            className="rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur-sm transition-all hover:bg-white/10 hover:border-[#C9A227]/30"
          >
            <div className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#C9A227]/15 text-[#C9A227]">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="28"
                height="28"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="2"
                strokeLinecap="round"
                strokeLinejoin="round"
              >
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
              </svg>
            </div>
            <h3 className="mb-2 text-xl font-bold text-white">{t(lang, "contact.follow_us")}</h3>
            <div className="flex gap-3">
              {["facebook", "linkedin", "twitter", "instagram"].map((social) => (
                <a
                  key={social}
                  href={`#${social}`}
                  className="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-white/60 transition-all hover:bg-[#C9A227] hover:text-[#0A1628]"
                >
                  <span className="text-sm font-bold uppercase">{social[0]}</span>
                </a>
              ))}
            </div>
          </motion.div>
        </motion.div>

        {/* Office Locations */}
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: "-100px" }}
          variants={containerVariants}
          className="mt-16"
        >
          <h2 className="mb-10 text-center text-3xl font-bold text-white">
            {t(lang, "contact.get_in_touch")}
          </h2>
          <div className="grid gap-8 md:grid-cols-3">
            {offices.map((office) => (
              <motion.div
                key={office.city}
                variants={itemVariants}
                className="rounded-2xl bg-white/5 border border-white/10 p-8 backdrop-blur-sm transition-all hover:-translate-y-1 hover:bg-white/10 hover:border-[#C9A227]/30"
              >
                <div className="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-[#C9A227]/15 text-[#C9A227]">
                  <office.icon size={28} />
                </div>
                <h3 className="mb-3 text-xl font-bold text-white">{office.city}</h3>
                <p className="mb-2 text-white/60 leading-relaxed">{office.address}</p>
                <p className="text-[#C9A227] font-medium">{office.phone}</p>
              </motion.div>
            ))}
          </div>
        </motion.div>
      </div>
    </section>
  );
}