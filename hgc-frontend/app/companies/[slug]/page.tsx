import { Metadata } from "next";
import CompanyProfileClient from "./CompanyProfileClient";

interface Props {
  params: Promise<{ slug: string }>;
}

export async function generateMetadata({ params }: Props): Promise<Metadata> {
  const { slug } = await params;
  const apiUrl = `${process.env.NEXT_PUBLIC_API_URL}/api/companies/${slug}?lang=en`;

  try {
    const res = await fetch(apiUrl, { next: { revalidate: 60 } });
    const json = await res.json();

    if (json.success) {
      const company = json.data;
      return {
        title: company.meta?.title || `${company.name} | Hafez Group`,
        description: company.meta?.description || company.description,
      };
    }
  } catch {
    // Fallback
  }

  return {
    title: "Company Profile | Hafez Group",
    description: "Hafez Group of Companies - Afghanistan",
  };
}

export default async function CompanyPage({ params }: Props) {
  const { slug } = await params;
  return <CompanyProfileClient slug={slug} />;
}