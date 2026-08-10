"use client";

import { useParams } from "next/navigation";
import Link from "next/link";
import Image from "next/image";
import { useState, useEffect } from "react";
import { useI18n } from "@/components/useI18nStore";
import { ArrowLeft, Calendar, Tag, Loader2 } from "lucide-react";

interface NewsDetail {
    id: number;
    slug: string;
    title: string;
    excerpt: string;
    content: string;
    category: string;
    cover_image: string | null;
    published_at: string;
}

export default function NewsDetailPage() {
    const { lang } = useI18n();
    const params = useParams();
    const slug = params.slug as string;

    const [article, setArticle] = useState<NewsDetail | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        if (!slug) return;
        const fetchArticle = async () => {
            try {
                setLoading(true);
                const res = await fetch(
                    `${process.env.NEXT_PUBLIC_API_URL}/api/news/${slug}?lang=${lang}`,
                    { headers: { Accept: "application/json" } }
                );
                if (!res.ok) throw new Error("Failed to fetch");
                const json = await res.json();
                if (json.success) setArticle(json.data);
            } catch (err) {
                console.error("News detail fetch error:", err);
            } finally {
                setLoading(false);
            }
        };
        fetchArticle();
    }, [slug, lang]);

    const formatDate = (dateStr: string) => {
        const date = new Date(dateStr);
        if (lang === "en")
            return date.toLocaleDateString("en-US", { year: "numeric", month: "long", day: "numeric" });
        if (lang === "dari")
            return date.toLocaleDateString("fa-AF", { year: "numeric", month: "long", day: "numeric" });
        return date.toLocaleDateString("ps-AF", { year: "numeric", month: "long", day: "numeric" });
    };

    if (loading) {
        return (
            <div className="min-h-screen bg-hgc-bg flex items-center justify-center">
                <Loader2 className="w-10 h-10 text-hgc-gold animate-spin" />
            </div>
        );
    }

    if (!article) {
        return (
            <div className="min-h-screen bg-hgc-bg flex items-center justify-center text-hgc-text-muted">
                {lang === "en" ? "Article not found." : lang === "dari" ? "مقاله یافت نشد." : "مقاله ونه موندل شوه."}
            </div>
        );
    }

    return (
        <article className="min-h-screen bg-hgc-bg">
            {/* Hero Image */}
            <div className="relative h-[50vh] lg:h-[60vh] w-full">
                {article.cover_image ? (
                    <Image
                        src={article.cover_image}
                        alt={article.title}
                        fill
                        className="object-cover"
                        priority
                    />
                ) : (
                    <div className="absolute inset-0 bg-gradient-to-br from-[#0F2B5B] to-[#1a1a2e]" />
                )}
                <div className="absolute inset-0 bg-gradient-to-t from-hgc-bg via-hgc-bg/60 to-transparent" />
                <div className="absolute inset-0 bg-gradient-to-r from-hgc-bg/40 to-transparent" />
            </div>

            {/* Content */}
            <div className="max-w-4xl mx-auto px-4 sm:px-6 -mt-32 relative z-10 pb-24">
                <Link
                    href="/"
                    className="inline-flex items-center gap-2 text-hgc-gold hover:text-hgc-gold-bright transition-colors mb-8"
                >
                    <ArrowLeft className="w-4 h-4" />
                    {lang === "en"
                        ? "Back to Home"
                        : lang === "dari"
                            ? "بازگشت به صفحه اصلی"
                            : "بیرته کور پاڼې ته"}
                </Link>

                <div className="flex items-center gap-4 mb-6">
                    <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-hgc-gold/10 text-hgc-gold text-sm font-medium border border-hgc-gold/20">
                        <Tag className="w-3.5 h-3.5" />
                        {article.category}
                    </span>
                    <span className="inline-flex items-center gap-1.5 text-hgc-text-muted text-sm">
                        <Calendar className="w-3.5 h-3.5" />
                        {formatDate(article.published_at)}
                    </span>
                </div>

                <h1 className="text-3xl lg:text-5xl font-bold text-hgc-text mb-8 leading-tight">
                    {article.title}
                </h1>

                <div className="prose prose-invert prose-lg max-w-none text-hgc-text/80 leading-relaxed">
                    {article.content ? (
                        <div dangerouslySetInnerHTML={{ __html: article.content }} />
                    ) : (
                        <p>{article.excerpt}</p>
                    )}
                </div>
            </div>
        </article>
    );
}