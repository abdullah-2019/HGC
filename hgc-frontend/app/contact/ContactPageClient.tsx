"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import Image from "next/image";
import {
  FaFacebookF,
  FaInstagram,
  FaXTwitter,
  FaLinkedinIn,
  FaYoutube,
  FaWhatsapp,
  FaTelegram,
  FaGlobe
} from "react-icons/fa6";
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
  Loader2,
} from "lucide-react";


import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { submitContactForm, ContactInfo } from "@/lib/api/contact";

interface Props {
  contactInfo: ContactInfo | null;
  error: string | null;
}

export default function ContactPageClient({ contactInfo, error }: Props) {
  const { lang, dir } = useI18n();

  const [status, setStatus] = useState<"idle" | "loading" | "success" | "error">("idle");
  const [errorMsg, setErrorMsg] = useState("");

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    phone: "",
    subject: "",
    message: "",
  });

  const handleChange = (
    e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>
  ) => {
    setFormData((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setStatus("loading");
    setErrorMsg("");

    try {
      await submitContactForm(formData);
      setStatus("success");
      setFormData({ name: "", email: "", phone: "", subject: "", message: "" });
      setTimeout(() => setStatus("idle"), 5000);
    } catch (err: any) {
      setStatus("error");
      setErrorMsg(err.message || t(lang, "contact.form_error"));
    }
  };

  const inputClasses =
    "w-full rounded-xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder-white/40 transition-all focus:border-[#C9A227] focus:outline-none focus:ring-2 focus:ring-[#C9A227]/20";

  // ─── Get localized field based on current language ─────────────────
  const getField = (baseField: keyof ContactInfo): string | null => {
    if (!contactInfo) return null;

    if (lang === "dari") {
      const dariField = `${baseField}_dari` as keyof ContactInfo;
      return (contactInfo[dariField] as string | null) || (contactInfo[baseField] as string | null);
    }
    if (lang === "pashto") {
      const pashtoField = `${baseField}_pashto` as keyof ContactInfo;
      return (contactInfo[pashtoField] as string | null) || (contactInfo[baseField] as string | null);
    }
    return contactInfo[baseField] as string | null;
  };

  const address = getField("address");
  const phones = getField("phones");
  const email = getField("email");
  const officeHours = getField("office_hours");

  const socialLinks = contactInfo
    ? ([
      { key: "facebook" as const, icon: FaFacebookF, label: "Facebook" },
      { key: "instagram" as const, icon: FaInstagram, label: "Instagram" },
      { key: "telegram" as const, icon: FaTelegram, label: "Telegram" },
      { key: "x" as const, icon: FaXTwitter, label: "X" },
      { key: "linkedin" as const, icon: FaLinkedinIn, label: "LinkedIn" },
      { key: "youtube" as const, icon: FaYoutube, label: "YouTube" },
      { key: "whatsapp" as const, icon: FaWhatsapp, label: "WhatsApp" },
    ] as const)
      .filter((item) => {
        const url = contactInfo[item.key];
        return typeof url === "string" && url.length > 0;
      })
      .map((item) => ({
        icon: item.icon,
        label: item.label,
        href: contactInfo[item.key] as string,
      }))
    : [];

  const containerVariants = {
    hidden: { opacity: 0 },
    visible: { opacity: 1, transition: { staggerChildren: 0.15 } },
  };

  const itemVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: { opacity: 1, y: 0, transition: { duration: 0.6 } },
  };

  const mapEmbedUrl =
    contactInfo?.map_embed_url ||
    "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3286.0!2d69.1760!3d34.5320!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDMxJzU1LjIiNiA2OcKwMTAnMzMuNiJF!5e0!3m2!1sen!2s!4v1";

  return (
    <main className="min-h-screen bg-[#0A1628]">
      {/* ========== HERO ========== */}
      <section className="relative h-[60vh] min-h-[400px] w-full overflow-hidden">
        <div className="absolute inset-0">
          <Image
            src="/images/contact-hero.webp"
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
            </motion.p>
          </div>
        </div>
      </section>

      {/* ========== FORM + INFO ========== */}
      <section className="relative overflow-hidden bg-[#0A1628] py-24" dir={dir}>
        <div className="absolute inset-0">
          <div className="absolute left-0 top-0 h-96 w-96 rounded-full bg-[#C9A227]/5 blur-3xl" />
          <div className="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-[#C9A227]/5 blur-3xl" />
        </div>

        <div className="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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

          <div className="grid gap-8 lg:grid-cols-5">
            {/* ---- FORM (3 cols) ---- */}
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
                        className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${dir === "rtl" ? "right-4" : "left-4"
                          }`}
                        size={20}
                      />
                      <input
                        type="text"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                        placeholder={t(lang, "contact.form_name")}
                        className={`${inputClasses} ${dir === "rtl" ? "pr-12" : "pl-12"
                          }`}
                        required
                      />
                    </div>
                    <div className="relative">
                      <Mail
                        className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${dir === "rtl" ? "right-4" : "left-4"
                          }`}
                        size={20}
                      />
                      <input
                        type="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                        placeholder={t(lang, "contact.form_email")}
                        className={`${inputClasses} ${dir === "rtl" ? "pr-12" : "pl-12"
                          }`}
                        required
                      />
                    </div>
                  </div>

                  <div className="relative">
                    <Phone
                      className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${dir === "rtl" ? "right-4" : "left-4"
                        }`}
                      size={20}
                    />
                    <input
                      type="tel"
                      name="phone"
                      value={formData.phone}
                      onChange={handleChange}
                      placeholder={t(lang, "contact.form_phone")}
                      dir="ltr"  // Phone numbers always LTR
                      className={`${inputClasses} ${dir === "rtl" ? "pr-12 text-right" : "pl-12 text-left"
                        }`}
                    />
                  </div>

                  <div className="relative">
                    <FileText
                      className={`absolute top-1/2 -translate-y-1/2 text-white/40 ${dir === "rtl" ? "right-4" : "left-4"}`}
                      size={20}
                    />
                    <input
                      type="text"
                      name="subject"
                      value={formData.subject}
                      onChange={handleChange}
                      placeholder={t(lang, "contact.form_subject")}
                      className={`${inputClasses} ${dir === "rtl" ? "pr-12" : "pl-12"}`}
                      required
                    />
                  </div>

                  <div className="relative">
                    <MessageSquare
                      className={`absolute top-4 text-white/40 ${dir === "rtl" ? "right-4" : "left-4"
                        }`}
                      size={20}
                    />
                    <textarea
                      name="message"
                      value={formData.message}
                      onChange={handleChange}
                      placeholder={t(lang, "contact.form_message")}
                      rows={5}
                      className={`${inputClasses} resize-none ${dir === "rtl" ? "pr-12" : "pl-12"
                        }`}
                      required
                    />
                  </div>

                  <button
                    type="submit"
                    disabled={status === "loading"}
                    className="group flex w-full items-center justify-center gap-3 rounded-xl bg-[#C9A227] px-8 py-4 text-lg font-semibold text-[#0A1628] transition-all hover:bg-[#D4AF37] hover:shadow-lg hover:shadow-[#C9A227]/20 active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed"
                  >
                    {status === "loading" ? (
                      <Loader2 size={20} className="animate-spin" />
                    ) : (
                      <Send
                        size={20}
                        className="transition-transform group-hover:translate-x-1"
                      />
                    )}
                    {status === "loading"
                      ? t(lang, "contact.form_sending") || "Sending..."
                      : t(lang, "contact.form_submit")}
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
                      {errorMsg || t(lang, "contact.form_error")}
                    </motion.div>
                  )}
                </form>
              </div>
            </motion.div>

            {/* ---- INFO CARDS (2 cols) ---- */}
            <motion.div
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true }}
              variants={containerVariants}
              className="flex flex-col gap-6 lg:col-span-2"
            >
              {/* Error */}
              {error && (
                <motion.div
                  variants={itemVariants}
                  className="rounded-2xl border border-red-500/20 bg-red-500/10 p-6 text-red-400"
                >
                  <p className="font-medium">Failed to load contact info</p>
                  <p className="mt-1 text-sm text-red-400/70">{error}</p>
                </motion.div>
              )}

              {/* Address + Phone + Email */}
              {address && (
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

                  <div className="flex items-start gap-3">
                    <MapPin
                      size={18}
                      className="mt-1 shrink-0 text-[#C9A227]"
                    />
                    <p className="text-white/60 leading-relaxed">{address}</p>
                  </div>

                  {phones && (
                    <div className="mt-4 flex items-center gap-3">
                      <Phone size={18} className="shrink-0 text-[#C9A227]" />
                      <a
                        href={`tel:${phones.replace(/\s/g, "")}`}
                        className="text-white/60 transition-colors hover:text-[#C9A227]"
                        dir="ltr"
                      >
                        {phones}
                      </a>
                    </div>
                  )}

                  {email && (
                    <div className="mt-3 flex items-center gap-3">
                      <Mail size={18} className="shrink-0 text-[#C9A227]" />
                      <a
                        href={`mailto:${email}`}
                        className="text-white/60 transition-colors hover:text-[#C9A227]"
                      >
                        {email}
                      </a>
                    </div>
                  )}
                </motion.div>
              )}

              {/* Office Hours */}
              {officeHours && (
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
                  <p className="text-white/60">{officeHours}</p>
                </motion.div>
              )}

              {/* Social Media */}
              {socialLinks.length > 0 && (
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
              )}
            </motion.div>
          </div>
        </div>
      </section>

      {/* ========== MAP ========== */}
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
              <span className="text-sm font-medium">
                {t(lang, "contact.find_us")}
              </span>
            </div>
            <h2 className="text-3xl font-bold text-white md:text-4xl">
              {t(lang, "contact.find_us")}
            </h2>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, y: 40 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="overflow-hidden rounded-2xl bg-white/5 border border-white/10"
          >
            <div className="relative h-[450px] w-full md:h-[500px]">
              <iframe
                src={mapEmbedUrl}
                width="100%"
                height="100%"
                style={{ border: 0 }}
                allowFullScreen
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
                title="HGC Kabul Office Location"
                className="grayscale-[20%] hover:grayscale-0 transition-all duration-500"
              />

              <div
                className={`absolute bottom-6 max-w-sm rounded-xl bg-[#0A1628]/95 border border-white/10 p-6 shadow-2xl backdrop-blur-sm ${dir === "rtl" ? "right-6" : "left-6"
                  }`}
              >
                <div className="flex items-start gap-4">
                  <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#C9A227]/15 text-[#C9A227]">
                    <MapPin size={18} />
                  </div>
                  <div>
                    <h4 className="text-base font-bold text-white">
                      {t(lang, "contact.kabul_office")}
                    </h4>
                    <p className="mt-1 text-xs text-white/60">
                      {address ||
                        "Share-Now, Old Taimani, Street No 3, Kabul, Afghanistan"}
                    </p>
                    {phones && (
                      <a
                        href={`tel:${phones.replace(/\s/g, "")}`}
                        className="mt-1.5 inline-block text-xs font-medium text-[#C9A227] hover:text-[#D4AF37]"
                        dir="ltr"
                      >
                        {phones}
                      </a>
                    )}
                  </div>
                </div>
              </div>
            </div>
          </motion.div>
        </div>
      </section>
    </main>
  );
}