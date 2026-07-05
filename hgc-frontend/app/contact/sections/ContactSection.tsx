"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import {
  Send,
  User,
  Mail,
  Phone,
  FileText,
  MessageSquare,
  Clock,
  MapPin,
  Building2,
} from "lucide-react";
import {
  FaFacebookF,
  FaInstagram,
  FaGlobe,    
} from "react-icons/fa6";
import { FaTelegramPlane } from "react-icons/fa";

import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

export default function ContactSection() {
  const { lang, dir } = useI18n();
  const [status, setStatus] = useState<"idle" | "success" | "error">("idle");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setStatus("success");
    setTimeout(() => setStatus("idle"), 5000);
  };

  const inputClasses =
    "w-full rounded-xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder-white/40 transition-all focus:border-[#C9A227] focus:outline-none focus:ring-2 focus:ring-[#C9A227]/20";

  const socialLinks = [
    { icon: FaFacebookF, href: "https://facebook.com", label: "Facebook" },
    { icon: FaInstagram, href: "https://instagram.com", label: "Instagram" },
    { icon: FaTelegramPlane, href: "https://t.me", label: "Telegram" },
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
    visible: {
      opacity: 1,
      y: 0,
      transition: { duration: 0.6 },
    },
  };

  return (
    <section className="relative overflow-hidden bg-[#0A1628] py-24" dir={dir}>
      {/* Background Glow */}
      <div className="absolute inset-0">
        <div className="absolute left-0 top-0 h-96 w-96 rounded-full bg-[#C9A227]/5 blur-3xl" />
        <div className="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-[#C9A227]/5 blur-3xl" />
      </div>

      <div className="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="mb-16 text-center"
        >
          <h2 className="text-4xl font-bold text-white md:text-5xl">
            {t(lang, "contact.send_message")}
          </h2>
          <p className="mx-auto mt-4 max-w-2xl text-lg text-white/60">
            {t(lang, "contact.hero_subtitle")}
          </p>
        </motion.div>

        {/* Main Grid: Form + Info Cards */}
        <div className="grid gap-8 lg:grid-cols-5">
          {/* Contact Form - 3 columns */}
          <motion.div
            initial={{ opacity: 0, x: dir === "rtl" ? 50 : -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="lg:col-span-3"
          >
            <div className="rounded-3xl border border-white/10 bg-white/5 p-8 backdrop-blur-xl md:p-10">
              <form onSubmit={handleSubmit} className="space-y-5">
                <div className="grid gap-5 sm:grid-cols-2">
                  <div className="relative">
                    <User
                      className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${
                        dir === "rtl" ? "right-4" : "left-4"
                      }`}
                      size={20}
                    />
                    <input
                      type="text"
                      placeholder={t(lang, "contact.form_name")}
                      className={`${inputClasses} ${dir === "rtl" ? "pr-12" : "pl-12"}`}
                      required
                    />
                  </div>

                  <div className="relative">
                    <Mail
                      className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${
                        dir === "rtl" ? "right-4" : "left-4"
                      }`}
                      size={20}
                    />
                    <input
                      type="email"
                      placeholder={t(lang, "contact.form_email")}
                      className={`${inputClasses} ${dir === "rtl" ? "pr-12" : "pl-12"}`}
                      required
                    />
                  </div>
                </div>

                <div className="grid gap-5 sm:grid-cols-2">
                  <div className="relative">
                    <Phone
                      className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${
                        dir === "rtl" ? "right-4" : "left-4"
                      }`}
                      size={20}
                    />
                    <input
                      type="tel"
                      placeholder={t(lang, "contact.form_phone")}
                      className={`${inputClasses} ${dir === "rtl" ? "pr-12" : "pl-12"}`}
                    />
                  </div>

                  <div className="relative">
                    <FileText
                      className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${
                        dir === "rtl" ? "right-4" : "left-4"
                      }`}
                      size={20}
                    />
                    <input
                      type="text"
                      placeholder={t(lang, "contact.form_subject")}
                      className={`${inputClasses} ${dir === "rtl" ? "pr-12" : "pl-12"}`}
                      required
                    />
                  </div>
                </div>

                <div className="relative">
                  <MessageSquare
                    className={`absolute top-4 text-white/40 ${
                      dir === "rtl" ? "right-4" : "left-4"
                    }`}
                    size={20}
                  />
                  <textarea
                    placeholder={t(lang, "contact.form_message")}
                    rows={5}
                    className={`${inputClasses} resize-none ${dir === "rtl" ? "pr-12" : "pl-12"}`}
                    required
                  />
                </div>

                <button
                  type="submit"
                  className="group flex w-full items-center justify-center gap-3 rounded-xl bg-[#C9A227] px-8 py-4 text-lg font-semibold text-[#0A1628] transition-all hover:bg-[#D4AF37] hover:shadow-lg hover:shadow-[#C9A227]/20 active:scale-[0.98]"
                >
                  <Send
                    size={20}
                    className="transition-transform group-hover:translate-x-1"
                  />
                  {t(lang, "contact.form_submit")}
                </button>

                {status === "success" && (
                  <motion.div
                    initial={{ opacity: 0, y: 10 }}
                    animate={{ opacity: 1, y: 0 }}
                    className="rounded-xl border border-green-500/20 bg-green-500/10 p-4 text-center text-green-400"
                  >
                    {t(lang, "contact.form_success")}
                  </motion.div>
                )}

                {status === "error" && (
                  <motion.div
                    initial={{ opacity: 0, y: 10 }}
                    animate={{ opacity: 1, y: 0 }}
                    className="rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-center text-red-400"
                  >
                    {t(lang, "contact.form_error")}
                  </motion.div>
                )}
              </form>
            </div>
          </motion.div>

          {/* Info Cards Column - 2 columns */}
          <motion.div
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            variants={containerVariants}
            className="flex flex-col gap-6 lg:col-span-2"
          >
            {/* Address + Phone + Email Combined */}
            <motion.div
              variants={itemVariants}
              className="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:border-[#C9A227]/30 hover:bg-white/10"
            >
              <div className="mb-4 flex items-center gap-3">
                <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-[#C9A227]/15 text-[#C9A227]">
                  <Building2 size={20} />
                </div>
                <h3 className="text-lg font-semibold text-white">
                  {t(lang, "contact.kabul_office")}
                </h3>
              </div>

              {/* Address */}
              <div className="flex items-start gap-3">
                <MapPin size={18} className="mt-1 shrink-0 text-[#C9A227]" />
                <p className="text-white/60 leading-relaxed">
                  Share-Now, Old Taimani, Street No 3, Kabul, Afghanistan
                </p>
              </div>

              {/* Phone */}
              <div className="mt-4 flex items-center gap-3">
                <Phone size={18} className="shrink-0 text-[#C9A227]" />
                <a
                  href="tel:+93711111694"
                  className="text-white/60 transition-colors hover:text-[#C9A227]"
                >
                  +93 (0) 711 111 694
                </a>
                <Mail size={18} className="shrink-0 text-[#C9A227]" />
                <a
                  href="mailto:info@hgc.af"
                  className="text-white/60 transition-colors hover:text-[#C9A227]"
                >
                  info@hgc.af
                </a>
              </div>

            </motion.div>

            {/* Office Hours */}
            <motion.div
              variants={itemVariants}
              className="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:border-[#C9A227]/30 hover:bg-white/10"
            >
              <div className="mb-4 flex items-center gap-3">
                <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-[#C9A227]/15 text-[#C9A227]">
                  <Clock size={20} />
                </div>
                <h3 className="text-lg font-semibold text-white">
                  {t(lang, "contact.office_hours")}
                </h3>
              </div>
              <p className="text-white/60">{t(lang, "contact.mon_fri")}</p>
              <p className="text-white/60">{t(lang, "contact.time")}</p>
            </motion.div>

            {/* Social Media */}
            <motion.div
              variants={itemVariants}
              className="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:border-[#C9A227]/30 hover:bg-white/10"
            >
              <div className="mb-5 flex items-center gap-3">
                <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-[#C9A227]/15 text-[#C9A227]">
                  <FaGlobe size={18} />
                </div>
                <h3 className="text-lg font-semibold text-white">
                  {t(lang, "contact.follow_us")}
                </h3>
              </div>
              <div className="flex flex-wrap gap-3">
                {socialLinks.map(({ icon: Icon, href, label }) => (
                  <a
                    key={label}
                    href={href}
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label={label}
                    className="flex h-12 w-12 items-center justify-center rounded-xl bg-[#C9A227]/10 text-[#C9A227] transition-all duration-300 hover:-translate-y-1 hover:bg-[#C9A227] hover:text-[#0A1628] hover:shadow-[0_0_25px_rgba(201,162,39,0.4)]"
                  >
                    <Icon size={18} />
                  </a>
                ))}
              </div>
            </motion.div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}