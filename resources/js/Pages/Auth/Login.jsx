import { useEffect } from "react";
import { Head, Link, useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError";

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset("password");
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route("login"));
    };

    return (
        <div className="w-full min-h-screen flex justify-center items-center bg-white font-primary">
            <Head title="Login" />

            {status && (
                <div className="absolute top-10 text-sm font-medium text-green-600 font-secondary">
                    {status}
                </div>
            )}

            <form
                onSubmit={submit}
                className="w-[390px] flex flex-col items-center px-9"
            >
                <div className="text-center mb-6">
                    <h1 className="text-4xl">Welcome Back</h1>
                    <h3 className="text-sm text-gray-500 font-secondary mt-1">
                        Sign in into your existing account
                    </h3>
                </div>

                <div className="w-full flex flex-col font-secondary">
                    {/* INPUT EMAIL */}
                    <div className="mb-3">
                        <input
                            type="email"
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                            className="w-full border-2 rounded border-gray-200 p-3.5 focus:border-tertiary focus:ring-0 outline-none transition-all"
                            placeholder="Enter email"
                            required
                        />
                        <InputError message={errors.email} className="mt-1" />
                    </div>

                    {/* INPUT PASSWORD */}
                    <div className="mb-3">
                        <input
                            type="password"
                            value={data.password}
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                            className="w-full border-2 rounded border-gray-200 p-3.5 focus:border-tertiary focus:ring-0 outline-none transition-all"
                            placeholder="Enter password"
                            required
                        />
                        <InputError
                            message={errors.password}
                            className="mt-1"
                        />
                    </div>

                    {/* REMEMBER ME & FORGOT PASSWORD */}
                    <div className="flex justify-between items-center px-1 mb-6">
                        <label className="flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                checked={data.remember}
                                onChange={(e) =>
                                    setData("remember", e.target.checked)
                                }
                                className="rounded border-gray-300 text-tertiary shadow-sm focus:ring-tertiary"
                            />
                            <span className="ms-2 text-xs text-gray-600">
                                Remember me
                            </span>
                        </label>

                        {canResetPassword && (
                            <Link
                                href={route("password.request")}
                                className="text-xs text-gray-600 hover:text-tertiary underline"
                            >
                                Forgot password?
                            </Link>
                        )}
                    </div>
                </div>

                {/* BUTTON SIGN IN */}
                <button
                    disabled={processing}
                    className={`w-full text-white bg-tertiary text-center py-3.5 rounded-3xl font-secondary font-semibold transition-all mb-6 ${processing ? "opacity-50 cursor-not-allowed" : "hover:opacity-90"}`}
                >
                    {processing ? "Signing In..." : "Sign In"}
                </button>

                <h4 className="text-sm font-secondary">
                    Don’t have an account?{" "}
                    <Link
                        href={route("register")}
                        className="font-bold text-tertiary hover:underline"
                    >
                        Sign up
                    </Link>
                </h4>
            </form>
        </div>
    );
}
