// import CompanyProfileHero from "./sections/CompanyProfileHero";
// import CompanyAbout from "./sections/CompanyAbout";
// import CompanyMissionVision from "./sections/CompanyMissionVision";
// import CompanyHistory from "./sections/CompanyHistory";
// import CompanyStats from "./sections/CompanyStats";
// import CompanyLeadership from "./sections/CompanyLeadership";
// import CompanyValues from "./sections/CompanyValues";
// import CompanyAwards from "./sections/CompanyAwards";

// export const metadata = {
//   title: "Company Profile - Hafez Group of Companies",
//   description: "Learn about Hafez Group of Companies - our history, mission, values, and leadership.",
// };

// export default function CompanyProfilePage() {
//   return (
//     <main className="min-h-screen bg-[#0A1628]">
//       <CompanyProfileHero />
//       <CompanyAbout />
//       <CompanyStats />
//       <CompanyMissionVision />
//       <CompanyHistory />
//       <CompanyValues />
//       <CompanyLeadership />
//       <CompanyAwards />
//     </main>
//   );
// }

// app/companies/[slug]/page.tsx
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