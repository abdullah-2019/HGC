"use client";

import React, { useState } from "react";
import { motion } from "framer-motion";
import {
  Mail,
  Phone,
  MapPin,
  Send,
  MessageCircle,
  CheckCircle2,
  ArrowRight,
  Clock,
  Globe,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import ScrollReveal from "@/components/ScrollReveal";

export default function ProductContact() {
  const { lang, dir } = useI18n();
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    company: "",
    product: "",
    quantity: "",
    message: "",
  });
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setSubmitted(true);
    setTimeout(() => setSubmitted(false), 4000);
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setFormData((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const contactInfo = [
    {
      icon: Mail,
      label: t(lang, "products.contact.emailLabel"),
      value: "info@hcrc-af.com",
      href: "mailto:info@hcrc-af.com",
    },
    {
      icon: Phone,
      label: t(lang, "products.contact.phoneLabel"),
      value: "+93 (0) 711 111 694",
      href: "tel:+93711111694",
    },
    {
      icon: MapPin,
      label: t(lang, "products.contact.addressLabel"),
      value: t(lang, "footer.address"),
      href: "#",
    },
    {
      icon: Clock,
      label: t(lang, "products.contact.hoursLabel"),
      value: "Sat - Thu: 8:00 AM - 5:00 PM",
      href: "#",
    },
  ];

  return (
    <section id="contact" className="py-24 relative" dir={dir}>
      <div className="absolute inset-0 bg-[#C9A227]/[0.02]" />
      <div className="absolute top-0 left-1/3 w-96 h-96 bg-[#C9A227]/5 rounded-full blur-3xl" />
      <div className="absolute bottom-0 right-1/3 w-96 h-96 bg-[#1A237E]/5 rounded-full blur-3xl" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Header */}
        <ScrollReveal>
          <div className="text-center mb-16">
            <span className="text-[#C9A227] text-sm font-semibold uppercase tracking-[0.2em] mb-3 block">
              {t(lang, "products.contact.sectionSubtitle")}
            </span>
            <h2 className="text-3xl lg:text-5xl font-bold text-white mb-4">
              {t(lang, "products.contact.sectionTitle")}
            </h2>
            <p className="text-white/40 max-w-2xl mx-auto text-lg">
              {t(lang, "products.contact.sectionDesc")}
            </p>
          </div>
        </ScrollReveal>

        <div className="grid lg:grid-cols-5 gap-12">
          {/* Contact Info */}
          <div className="lg:col-span-2 space-y-6">
            {contactInfo.map((item, idx) => {
              const Icon = item.icon;
              return (
                <ScrollReveal key={idx} delay={idx * 0.1}>
                  <a
                    href={item.href}
                    className="group flex items-start gap-4 p-5 bg-white/[0.02] border border-white/5 rounded-2xl hover:border-[#C9A227]/20 hover:bg-white/[0.04] transition-all duration-300"
                  >
                    <div className="w-11 h-11 rounded-xl bg-[#C9A227]/10 flex items-center justify-center flex-shrink-0 group-hover:bg-[#C9A227]/20 transition-colors">
                      <Icon className="w-5 h-5 text-[#C9A227]" />
                    </div>
                    <div>
                      <p className="text-white/30 text-xs uppercase tracking-wider mb-1">
                        {item.label}
                      </p>
                      <p className="text-white font-medium text-sm group-hover:text-[#C9A227] transition-colors">
                        {item.value}
                      </p>
                    </div>
                  </a>
                </ScrollReveal>
              );
            })}

            {/* WhatsApp CTA */}
            <ScrollReveal delay={0.4}>
              <a
                href="https://wa.me/93703420311"
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center gap-4 p-5 bg-green-500/5 border border-green-500/10 rounded-2xl hover:bg-green-500/10 hover:border-green-500/20 transition-all duration-300"
              >
                <div className="w-11 h-11 rounded-xl bg-green-500/15 flex items-center justify-center flex-shrink-0">
                  <MessageCircle className="w-5 h-5 text-green-400" />
                </div>
                <div>
                  <p className="text-green-400 text-xs uppercase tracking-wider mb-1">
                    WhatsApp
                  </p>
                  <p className="text-white font-medium text-sm">
                    +93 (0) 703 420 311
                  </p>
                </div>
                <ArrowRight className="w-4 h-4 text-green-400 ml-auto" />
              </a>
            </ScrollReveal>
          </div>

          {/* Form */}
          <ScrollReveal delay={0.2} className="lg:col-span-3">
            <form
              onSubmit={handleSubmit}
              className="p-8 bg-white/[0.02] border border-white/5 rounded-2xl space-y-5"
            >
              {submitted ? (
                <motion.div
                  initial={{ opacity: 0, scale: 0.9 }}
                  animate={{ opacity: 1, scale: 1 }}
                  className="py-16 text-center"
                >
                  <div className="w-16 h-16 rounded-full bg-green-500/15 flex items-center justify-center mx-auto mb-4">
                    <CheckCircle2 className="w-8 h-8 text-green-400" />
                  </div>
                  <h3 className="text-white font-bold text-xl mb-2">
                    {t(lang, "products.contact.formSuccess")}
                  </h3>
                  <p className="text-white/40">
                    {t(lang, "products.contact.formSuccessDesc")}
                  </p>
                </motion.div>
              ) : (
                <>
                  <div className="grid sm:grid-cols-2 gap-5">
                    <div>
                      <label className="text-white/40 text-xs uppercase tracking-wider mb-2 block">
                        {t(lang, "products.contact.nameLabel")}
                      </label>
                      <input
                        type="text"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                        required
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-white/20 focus:outline-none focus:border-[#C9A227]/50 transition-all"
                        placeholder="John Doe"
                      />
                    </div>
                    <div>
                      <label className="text-white/40 text-xs uppercase tracking-wider mb-2 block">
                        {t(lang, "products.contact.emailLabel")}
                      </label>
                      <input
                        type="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                        required
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-white/20 focus:outline-none focus:border-[#C9A227]/50 transition-all"
                        placeholder="john@company.com"
                      />
                    </div>
                  </div>

                  <div className="grid sm:grid-cols-2 gap-5">
                    <div>
                      <label className="text-white/40 text-xs uppercase tracking-wider mb-2 block">
                        {t(lang, "products.contact.companyLabel")}
                      </label>
                      <input
                        type="text"
                        name="company"
                        value={formData.company}
                        onChange={handleChange}
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-white/20 focus:outline-none focus:border-[#C9A227]/50 transition-all"
                        placeholder="Your Company"
                      />
                    </div>
                    <div>
                      <label className="text-white/40 text-xs uppercase tracking-wider mb-2 block">
                        {t(lang, "products.contact.productLabel")}
                      </label>
                      <select
                        name="product"
                        value={formData.product}
                        onChange={handleChange}
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-[#C9A227]/50 transition-all appearance-none"
                      >
                        <option value="" className="bg-[#0A1628]">Select Product</option>
                        <option value="minerals" className="bg-[#0A1628]">Minerals & Metals</option>
                        <option value="stones" className="bg-[#0A1628]">Stones & Gemstones</option>
                        <option value="refinery" className="bg-[#0A1628]">Refinery Products</option>
                        <option value="construction" className="bg-[#0A1628]">Construction Materials</option>
                        <option value="chemicals" className="bg-[#0A1628]">Industrial Chemicals</option>
                      </select>
                    </div>
                  </div>

                  <div>
                    <label className="text-white/40 text-xs uppercase tracking-wider mb-2 block">
                      {t(lang, "products.contact.quantityLabel")}
                    </label>
                    <input
                      type="text"
                      name="quantity"
                      value={formData.quantity}
                      onChange={handleChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-white/20 focus:outline-none focus:border-[#C9A227]/50 transition-all"
                      placeholder="e.g. 500 MT, 1000 units"
                    />
                  </div>

                  <div>
                    <label className="text-white/40 text-xs uppercase tracking-wider mb-2 block">
                      {t(lang, "products.contact.messageLabel")}
                    </label>
                    <textarea
                      name="message"
                      value={formData.message}
                      onChange={handleChange}
                      rows={4}
                      className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-white/20 focus:outline-none focus:border-[#C9A227]/50 transition-all resize-none"
                      placeholder="Tell us about your requirements..."
                    />
                  </div>

                  <button
                    type="submit"
                    className="w-full flex items-center justify-center gap-2 px-8 py-4 bg-[#C9A227] text-[#0A1628] font-bold rounded-xl hover:bg-[#C9A227]/90 transition-all duration-300"
                  >
                    <Send className="w-5 h-5" />
                    {t(lang, "products.contact.submitBtn")}
                  </button>
                </>
              )}
            </form>
          </ScrollReveal>
        </div>
      </div>
    </section>
  );
}
