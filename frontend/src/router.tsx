import { createBrowserRouter, Navigate } from "react-router-dom";

import { AuthRoot } from "./pages";
import { LoginPage, RegisterPage } from "./pages/auth";

export enum AppRoutes {
  DEFAULT = "",
  AUTH = "auth",
  LOGIN = "login",
  REGISTER = "register",
}

export const router = createBrowserRouter([
  {
    path: AppRoutes.AUTH,
    element: <AuthRoot />,
    children: [
      {
        index: true,
        element: <Navigate to={AppRoutes.LOGIN} replace />,
      },
      {
        path: AppRoutes.LOGIN,
        element: <LoginPage />,
      },
      {
        path: AppRoutes.REGISTER,
        element: <RegisterPage />,
      },
    ],
  },
  {
    path: AppRoutes.DEFAULT,
    element: <Navigate to={AppRoutes.AUTH} replace />,
  },
]);
