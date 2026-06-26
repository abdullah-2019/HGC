import type { Metadata } from "next";
import { Inter, Vazirmatn } from "next/font/google";
import "./globals.css";
import Header from "@/components/Header";
import Footer from "@/components/Footer";

const inter = Inter({
  subsets: ["latin"],
  variable: "--font-inter",
});

const vazirmatn = Vazirmatn({
  subsets: ["arabic"],
  variable: "--font-vazirmatn",
});

export const metadata: Metadata = {
  title: "Hafez Group of Companies | HGC",
  description:
    "Transforming Afghanistan through construction, mining, logistics, and financial services since 2001.",
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en" suppressHydrationWarning>
      <body
        className={`${inter.variable} ${vazirmatn.variable} bg-[#0A1628] min-h-screen font-sans antialiased`}
      >
        <Header />
        <main className="pt-20 lg:pt-24">{children}</main>
        <Footer />
      </body>
    </html>
  );
}