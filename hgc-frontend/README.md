## Project Structure

### About Page
```text
app/
├── about/
│   ├── page.tsx
│   └── sections/
│       ├── HeroBanner.tsx
│       ├── AboutStory.tsx
│       ├── ImageCarousel.tsx
│       ├── MissionSection.tsx
│       ├── VisionSection.tsx
│       ├── CoreValues.tsx
│       ├── LeadershipTeam.tsx
│       ├── Timeline.tsx
│       └── StatsShowcase.tsx
├── components/
│   └── AnimatedCounter.tsx
└── styles/
    └── about.css
```

### Projects Page:
```text
app/
├── projects/
│   ├── page.tsx
│   └── sections/
│       ├── ProjectsHero.tsx
│       ├── CompanyFilter.tsx
│       ├── ProjectsGrid.tsx
│       └── ProjectCard.tsx
├── components/
│   └── ScrollReveal.tsx
└── hooks/
    └── useCountUp.ts
```

### Project Details: 
```text
app/
├── projects/
│   ├── [slug]/
│   │   ├── page.tsx                  # Server Component (metadata)
│   │   └── ProjectDetailClient.tsx   # Client Component
│   └── sections/
│       ├── ProjectHero.tsx
│       ├── ProjectOverview.tsx
│       ├── ProjectSpecs.tsx
│       ├── ProjectGallery.tsx
│       ├── ProjectMilestones.tsx
│       └── RelatedProjects.tsx
```
