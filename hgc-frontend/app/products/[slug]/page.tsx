"use client";

import React, { useState, useEffect } from "react";
import { useParams } from "next/navigation";
import { motion } from "framer-motion";
import {
    ArrowLeft,
    Package,
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
            case "in_stock": return "bg-green-500/15 text-green-700 border-green-500/30";
            case "limited": return "bg-yellow-500/15 text-yellow-700 border-yellow-500/30";
            case "pre_order": return "bg-blue-500/15 text-blue-700 border-blue-500/30";
            default: return "bg-red-500/15 text-red-700 border-red-500/30";
        }
    };

    if (loading) {
        return (
            <div className="min-h-screen bg-hgc-bg flex items-center justify-center">
                <Loader2 className="w-8 h-8 text-hgc-gold animate-spin" />
            </div>
        );
    }

    if (error || !product) {
        return (
            <div className="min-h-screen bg-hgc-bg flex items-center justify-center">
                <div className="text-center">
                    <AlertCircle className="w-12 h-12 text-red-500 mx-auto mb-4" />
                    <p className="text-hgc-text-secondary">{error || t(lang, "products.detail.notFound")}</p>
                    <a
                        href="/products"
                        className="inline-flex items-center gap-2 mt-4 text-hgc-gold hover:underline"
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
        <div className="min-h-screen bg-hgc-bg" dir={dir}>
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
                <a
                    href="/products"
                    className="inline-flex items-center gap-2 text-hgc-text-muted hover:text-hgc-gold transition-colors text-sm"
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
                        <div className="relative aspect-square rounded-2xl overflow-hidden bg-hgc-surface-elevated border border-hgc-border">
                            {currentImage ? (
                                <div
                                    className="absolute inset-0 bg-cover bg-center"
                                    style={{ backgroundImage: `url(${currentImage.url})` }}
                                />
                            ) : (
                                <div className="absolute inset-0 flex items-center justify-center text-hgc-text-muted/40">
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
                                        className={`w-20 h-20 rounded-lg overflow-hidden border-2 transition-all ${idx === activeImage ? "border-hgc-gold" : "border-hgc-border hover:border-hgc-text-muted"}
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
                                <span className="text-sm text-hgc-gold font-medium">
                                    {product.category.name}
                                </span>
                            )}
                            {product.company && (
                                <>
                                    <span className="text-hgc-text-muted">•</span>
                                    <span
                                        className="text-sm px-3 py-1 rounded-full bg-hgc-surface-elevated text-hgc-text-secondary border border-hgc-border"
                                        style={product.company.accent_color ? {
                                            backgroundColor: `${product.company.accent_color}15`,
                                            color: product.company.accent_color,
                                            borderColor: `${product.company.accent_color}30`,
                                        } : undefined}
                                    >
                                        <Factory className="w-3 h-3 inline mr-1" />
                                        {product.company.name}
                                    </span>
                                </>
                            )}
                        </div>

                        <h1 className="text-3xl lg:text-4xl font-bold text-hgc-text">
                            {product.name}
                        </h1>

                        {product.tagline && (
                            <p className="text-hgc-text-secondary text-lg">{product.tagline}</p>
                        )}

                        <div className={`inline-flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-medium ${getAvailabilityColor(product.availability)}`}>
                            <span className="w-2 h-2 rounded-full bg-current" />
                            {product.availability_label}
                        </div>

                        {product.overview && (
                            <div
                                className="text-hgc-text-secondary leading-relaxed prose max-w-none"
                                dangerouslySetInnerHTML={{ __html: product.overview }}
                            />
                        )}

                        {product.origin && (
                            <div className="flex items-center gap-2 text-hgc-text-muted text-sm">
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