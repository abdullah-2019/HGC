import { Metadata } from "next";
import ContactPageClient from "./ContactPageClient";
import { fetchContactInfo } from "@/lib/api/contact";

export const metadata: Metadata = {
  title: "Contact | Hafez Group of Companies",
  description: "Get in touch with Hafez Group of Companies across Afghanistan.",
};

export default async function ContactPage() {
  let contactInfo = null;
  let fetchError = null;

  try {
    contactInfo = await fetchContactInfo();
  } catch (err: any) {
    fetchError = err.message;
    console.error("Contact fetch error:", err.message);
  }

  return <ContactPageClient contactInfo={contactInfo} error={fetchError} />;
}