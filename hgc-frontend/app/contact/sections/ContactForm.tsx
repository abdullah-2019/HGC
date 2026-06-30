"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import { Send, User, Mail, Phone, FileText, MessageSquare } from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";

export default function ContactForm() {
  const { lang, dir } = useI18n();
  const [status, setStatus] = useState<"idle" | "success" | "error">("idle");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setStatus("success");
    setTimeout(() => setStatus("idle"), 5000);
  };

  const inputClasses =
    "w-full rounded-xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder-white/40 transition-all focus:border-[#C9A227] focus:outline-none focus:ring-2 focus:ring-[#C9A227]/20";

  return (
    <section className="bg-[#0A1628] py-20" dir={dir}>
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="grid gap-16 lg:grid-cols-2">
          {/* Left Side - Image */}
          <motion.div
            initial={{ opacity: 0, x: dir === "rtl" ? 50 : -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="relative hidden lg:block"
          >
            <div className="sticky top-24 overflow-hidden rounded-2xl">
              <img
                src="/images/placeholder.png"
                alt="HGC Office Building"
                className="h-[600px] w-full object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-[#0A1628]/80 via-transparent to-transparent" />
              <div className="absolute bottom-8 left-8 right-8">
                <h3 className="text-2xl font-bold text-white mb-2">
                  {t(lang, "contact.send_message")}
                </h3>
                <p className="text-white/70">
                  {t(lang, "contact.hero_subtitle")}
                </p>
              </div>
            </div>
          </motion.div>

          {/* Right Side - Form */}
          <motion.div
            initial={{ opacity: 0, x: dir === "rtl" ? -50 : 50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
          >
            <div className="mb-8">
              <h2 className="mb-3 text-3xl font-bold text-white">
                {t(lang, "contact.send_message")}
              </h2>
              <p className="text-white/60">{t(lang, "contact.hero_subtitle")}</p>
            </div>

            <form onSubmit={handleSubmit} className="space-y-5">
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
                <Send size={20} className="transition-transform group-hover:translate-x-1" />
                {t(lang, "contact.form_submit")}
              </button>

              {status === "success" && (
                <motion.div
                  initial={{ opacity: 0, y: 10 }}
                  animate={{ opacity: 1, y: 0 }}
                  className="rounded-xl bg-green-500/10 border border-green-500/20 p-4 text-center text-green-400"
                >
                  {t(lang, "contact.form_success")}
                </motion.div>
              )}

              {status === "error" && (
                <motion.div
                  initial={{ opacity: 0, y: 10 }}
                  animate={{ opacity: 1, y: 0 }}
                  className="rounded-xl bg-red-500/10 border border-red-500/20 p-4 text-center text-red-400"
                >
                  {t(lang, "contact.form_error")}
                </motion.div>
              )}
            </form>
          </motion.div>
        </div>
      </div>
    </section>
  );
}