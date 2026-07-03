// components/company/iconMap.ts
import { Shield, Handshake, Lightbulb, Heart, Scale, Leaf } from "lucide-react";
import {
  Building2,
  Mountain,
  HardHat,
  Store,
  Landmark,
  Truck,
} from "lucide-react";

export const iconMap: Record<string, React.ElementType> = {
  Building2,
  Mountain,
  HardHat,
  Store,
  Landmark,
  Truck,
};

export const valueIconMap: Record<string, React.ComponentType<{ size?: number; style?: React.CSSProperties }>> = {
  Shield,
  Handshake,
  Lightbulb,
  Heart,
  Scale,
  Leaf,
};