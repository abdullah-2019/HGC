"use client";

import React, { useState, useEffect } from "react";
import { useParams } from "next/navigation";
import { motion } from "framer-motion";
import {
    ArrowLeft,
    Check,
    Package,
    Truck,
    Globe,
    Factory,
    Loader2,
    AlertCircle,
} from "lucide-react";
import { useI18n } from "@/components/useI18nStore";
import { t } from "@/components/translations";
import { getProductBySlug, type ProductDetail } from "@/lib/api";

export default function ProductDetailPage() {
    const { lang, dir } = useI18n();
    const params = useParams();
    const slug = params.slug as string;

    const [product, setProduct] = useState<ProductDetail | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [activeImage, setActiveImage] = useState(0);

    useEffect(() => {
        if (!slug) return;

        getProductBySlug(slug, lang)
            .then((res) => {
                if (res.success) {
                    setProduct(res.data);
                } else {
                    setError(t(lang, "products.detail.notFound"));
                }
            })
            .catch(() => setError(t(lang, "products.detail.error")))
            .finally(() => setLoading(false));
    }, [slug, lang]);

    const getAvailabilityColor = (status: string) => {
        switch (status) {
            case "in_stock": return "bg-green-500/20 text-green-400 border-green-500/30";
            case "limited": return "bg-yellow-500/20 text-yellow-400 border-yellow-500/30";
            case "pre_order": return "bg-blue-500/20 text-blue-400 border-blue-500/30";
            default: return "bg-red-500/20 text-red-400 border-red-500/30";
        }
    };

    if (loading) {
        return (
            <div className="min-h-screen bg-[#0A1628] flex items-center justify-center">
                <Loader2 className="w-8 h-8 text-[#C9A227] animate-spin" />
            </div>
        );
    }

    if (error || !product) {
        return (
            <div className="min-h-screen bg-[#0A1628] flex items-center justify-center">
                <div className="text-center">
                    <AlertCircle className="w-12 h-12 text-red-400 mx-auto mb-4" />
                    <p className="text-white/60">{error || t(lang, "products.detail.notFound")}</p>
                    <a
                        href="/products"
                        className="inline-flex items-center gap-2 mt-4 text-[#C9A227] hover:underline"
                    >
                        <ArrowLeft className="w-4 h-4" />
                        {t(lang, "products.detail.backToProducts")}
                    </a>
                </div>
            </div>
        );
    }

    const images = product.images || [];
    const currentImage = images[activeImage] || product.primary_image;

    return (
        <div className="min-h-screen bg-[#0A1628]" dir={dir}>
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
                <a
                    href="/products"
                    className="inline-flex items-center gap-2 text-white/40 hover:text-[#C9A227] transition-colors text-sm"
                >
                    <ArrowLeft className="w-4 h-4" />
                    {t(lang, "products.detail.backToProducts")}
                </a>
            </div>

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <motion.div
                        initial={{ opacity: 0, x: -20 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ duration: 0.5 }}
                    >
                        <div className="relative aspect-square rounded-2xl overflow-hidden bg-white/5">
                            {currentImage ? (
                                <div
                                    className="absolute inset-0 bg-cover bg-center"
                                    style={{ backgroundImage: `url(${currentImage.url})` }}
                                />
                            ) : (
                                <div className="absolute inset-0 flex items-center justify-center text-white/20">
                                    <Package className="w-16 h-16" />
                                </div>
                            )}
                        </div>

                        {images.length > 1 && (
                            <div className="flex gap-3 mt-4">
                                {images.map((img, idx) => (
                                    <button
                                        key={idx}
                                        onClick={() => setActiveImage(idx)}
                                        className={`w-20 h-20 rounded-lg overflow-hidden border-2 transition-all ${idx === activeImage ? "border-[#C9A227]" : "border-white/10 hover:border-white/30"
                                            }`}
                                    >
                                        <div
                                            className="w-full h-full bg-cover bg-center"
                                            style={{ backgroundImage: `url(${img.url})` }}
                                        />
                                    </button>
                                ))}
                            </div>
                        )}
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, x: 20 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ duration: 0.5, delay: 0.2 }}
                        className="space-y-6"
                    >
                        <div className="flex items-center gap-3 flex-wrap">
                            {product.category && (
                                <span className="text-sm text-[#C9A227] font-medium">
                                    {product.category.name}
                                </span>
                            )}
                            {product.company && (
                                <>
                                    <span className="text-white/20">•</span>
                                    <span
                                        className="text-sm px-3 py-1 rounded-full bg-white/5 text-white/60"
                                        style={product.company.accent_color ? {
                                            backgroundColor: `${product.company.accent_color}20`,
                                            color: product.company.accent_color,
                                        } : undefined}
                                    >
                                        <Factory className="w-3 h-3 inline mr-1" />
                                        {product.company.name}
                                    </span>
                                </>
                            )}
                        </div>

                        <h1 className="text-3xl lg:text-4xl font-bold text-white">
                            {product.name}
                        </h1>

                        {product.tagline && (
                            <p className="text-white/50 text-lg">{product.tagline}</p>
                        )}

                        <div className={`inline-flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-medium ${getAvailabilityColor(product.availability)}`}>
                            <span className="w-2 h-2 rounded-full bg-current" />
                            {product.availability_label}
                        </div>

                        {product.overview && (
                            <div
                                className="text-white/60 leading-relaxed prose prose-invert max-w-none"
                                dangerouslySetInnerHTML={{ __html: product.overview }}
                            />
                        )}

                        {product.origin && (
                            <div className="flex items-center gap-2 text-white/40 text-sm">
                                <Globe className="w-4 h-4" />
                                <span>{t(lang, "products.detail.origin")}: {product.origin}</span>
                            </div>
                        )}
                    </motion.div>
                </div>
            </div>
        </div>
    );
}