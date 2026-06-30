import ContactHero from "./sections/ContactHero";
import ContactInfo from "./sections/ContactInfo";
import ContactForm from "./sections/ContactForm";
import ContactMap from "./sections/ContactMap";

export const metadata = {
  title: "Contact Us - Hafez Group of Companies",
  description: "Get in touch with Hafez Group of Companies",
};

export default function ContactPage() {
  return (
    <main className="min-h-screen bg-white">
      <ContactHero />
      <ContactInfo />
      <ContactForm />
      <ContactMap />
    </main>
  );
}