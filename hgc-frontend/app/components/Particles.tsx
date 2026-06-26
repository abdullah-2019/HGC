"use client";

import { useState, useEffect } from "react";

interface Particle {
  left: string;
  top: string;
  delay: string;
  duration: string;
}

export default function Particles({ count = 30 }: { count?: number }) {
  const [particles, setParticles] = useState<Particle[] | null>(null);

  useEffect(() => {
    setParticles(
      [...Array(count)].map(() => ({
        left: `${Math.random() * 100}%`,
        top: `${Math.random() * 100}%`,
        delay: `${Math.random() * 5}s`,
        duration: `${2 + Math.random() * 4}s`,
      }))
    );
  }, [count]);

  if (!particles) return null;

  return (
    <div className="absolute inset-0 overflow-hidden">
      {particles.map((p, i) => (
        <div
          key={i}
          className="absolute w-1 h-1 bg-[#C9A227]/40 rounded-full animate-pulse"
          style={{
            left: p.left,
            top: p.top,
            animationDelay: p.delay,
            animationDuration: p.duration,
          }}
        />
      ))}
    </div>
  );
}