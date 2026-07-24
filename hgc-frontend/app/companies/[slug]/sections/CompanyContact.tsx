"use client";

import { motion } from "framer-motion";
import { useI18n } from "@/components/useI18nStore";
import {
    MapPin,
    Phone,
    Mail,
    Globe,
    ExternalLink,
    MessageCircle,
    Briefcase,
    AtSign,
    Camera,
} from "lucide-react";

interface CompanyContactProps {
    company: {
        name: string;
        accent_color: string;
        contact: {
            email: string | null;
            phone: string | null;
            address: string | null;
            latitude: string | null;
            longitude: string | null;
        };
        web: {
            website: string | null;
            facebook: string | null;
            linkedin: string | null;
            twitter: string | null;
            instagram: string | null;
        };
    };
}

const socialConfig = [
    { key: "website", icon: Globe, label: "Website", color: "#C9A227" },
    { key: "facebook", icon: MessageCircle, label: "Facebook", color: "#1877F2" },
    { key: "linkedin", icon: Briefcase, label: "LinkedIn", color: "#0A66C2" },
    { key: "twitter", icon: AtSign, label: "Twitter", color: "#1DA1F2" },
    { key: "instagram", icon: Camera, label: "Instagram", color: "#E4405F" },
];

export default function CompanyContact({ company }: CompanyContactProps) {
    const { lang, dir } = useI18n();

    const hasContact =
        company.contact.email ||
        company.contact.phone ||
        company.contact.address ||
        company.contact.latitude;

    const hasSocial = Object.values(company.web).some((v) => v);

    if (!hasContact && !hasSocial) return null;

    const t = {
        en: { badge: "Get in Touch", title: "Contact Us", addr: "Address", phone: "Phone", email: "Email", follow: "Follow Us", noMap: "Map location not available" },
        dari: { badge: "در تماس باشید", title: "تماس با ما", addr: "آدرس", phone: "تلفن", email: "ایمیل", follow: "ما را دنبال کنید", noMap: "موقعیت نقشه در دسترس نیست" },
        pashto: { badge: "اړیکه ونیسئ", title: "زموږ سره اړیکه", addr: "پته", phone: "تلیفون", email: "برېښنالیک", follow: "موږ تعقیب کړئ", noMap: "د نقشې موقعیت شتون نلري" },
    }[lang as "en" | "dari" | "pashto"] ?? t.en;

    return (
        <section className="py-20 bg-[#070F1A]" dir={dir}>
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
                        {t.badge}
                    </div>
                    <h2 className="text-3xl font-bold text-white md:text-4xl">{t.title}</h2>
                </motion.div>

                <div className="grid gap-8 lg:grid-cols-2">
                    {/* Contact Cards */}
                    <motion.div
                        initial={{ opacity: 0, x: dir === "rtl" ? 50 : -50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true }}
                        className="space-y-6"
                    >
                        {company.contact.address && (
                            <div className="flex items-start gap-4 rounded-2xl bg-white/5 border border-white/10 p-6">
                                <div
                                    className="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl"
                                    style={{ backgroundColor: `${company.accent_color}15` }}
                                >
                                    <MapPin size={24} style={{ color: company.accent_color }} />
                                </div>
                                <div>
                                    <h3 className="mb-1 text-lg font-bold text-white">{t.addr}</h3>
                                    <p className="text-white/60 leading-relaxed">{company.contact.address}</p>
                                </div>
                            </div>
                        )}

                        {company.contact.phone && (
                            <div className="flex items-start gap-4 rounded-2xl bg-white/5 border border-white/10 p-6">
                                <div
                                    className="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl"
                                    style={{ backgroundColor: `${company.accent_color}15` }}
                                >
                                    <Phone size={24} style={{ color: company.accent_color }} />
                                </div>
                                <div>
                                    <h3 className="mb-1 text-lg font-bold text-white">{t.phone}</h3>
                                    <a href={`tel:${company.contact.phone}`} className="text-white/60 hover:text-white transition-colors">
                                        {company.contact.phone}
                                    </a>
                                </div>
                            </div>
                        )}

                        {company.contact.email && (
                            <div className="flex items-start gap-4 rounded-2xl bg-white/5 border border-white/10 p-6">
                                <div
                                    className="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl"
                                    style={{ backgroundColor: `${company.accent_color}15` }}
                                >
                                    <Mail size={24} style={{ color: company.accent_color }} />
                                </div>
                                <div>
                                    <h3 className="mb-1 text-lg font-bold text-white">{t.email}</h3>
                                    <a href={`mailto:${company.contact.email}`} className="text-white/60 hover:text-white transition-colors">
                                        {company.contact.email}
                                    </a>
                                </div>
                            </div>
                        )}
                    </motion.div>

                    {/* Map + Social */}
                    <motion.div
                        initial={{ opacity: 0, x: dir === "rtl" ? -50 : 50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true }}
                        className="flex flex-col gap-6"
                    >
                        {company.contact.latitude && company.contact.longitude ? (
                            <div className="rounded-2xl overflow-hidden border border-white/10 h-[300px]">
                                <iframe
                                    width="100%"
                                    height="100%"
                                    style={{ border: 0, filter: "grayscale(100%) invert(92%) contrast(83%)" }}
                                    loading="lazy"
                                    allowFullScreen
                                    referrerPolicy="no-referrer-when-downgrade"
                                    src={`https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2000!2d${company.contact.longitude}!3d${company.contact.latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!5e0!3m2!1sen!2s!4v1`}
                                />
                            </div>
                        ) : (
                            <div className="flex h-[300px] items-center justify-center rounded-2xl bg-white/5 border border-white/10">
                                <p className="text-white/30 text-sm">{t.noMap}</p>
                            </div>
                        )}

                        {hasSocial && (
                            <div className="rounded-2xl bg-white/5 border border-white/10 p-6">
                                <h3 className="mb-4 text-lg font-bold text-white">{t.follow}</h3>
                                <div className="flex flex-wrap gap-3">
                                    {socialConfig.map((s) => {
                                        const url = company.web[s.key as keyof typeof company.web];
                                        if (!url) return null;
                                        return (
                                            <a
                                                key={s.key}
                                                href={url}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-medium transition-all hover:scale-105"
                                                style={{
                                                    backgroundColor: `${s.color}15`,
                                                    border: `1px solid ${s.color}30`,
                                                    color: s.color,
                                                }}
                                            >
                                                <s.icon size={18} />
                                                <span>{s.label}</span>
                                                <ExternalLink size={12} className="opacity-50" />
                                            </a>
                                        );
                                    })}
                                </div>
                            </div>
                        )}
                    </motion.div>
                </div>
            </div>
        </section>
    );
}