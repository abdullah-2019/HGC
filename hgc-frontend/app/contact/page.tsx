import ContactHero from "./sections/ContactHero";
import ContactMap from "./sections/ContactMap";
import ContactSection from "./sections/ContactSection";

export const metadata = {
  title: "Contact Us - Hafez Group of Companies",
  description: "Get in touch with Hafez Group of Companies",
};

export default function ContactPage() {
  return (
    <main className="min-h-screen bg-white">
      <ContactHero />
      <ContactSection />
      <ContactMap />
    </main>
  );
}
